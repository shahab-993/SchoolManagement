<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassSubjectTeacher;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function index(
        SchoolClass $schoolClass,
        Subject $subject
    ) {
        // Check that this subject is assigned to this class
        $assignmentExists = ClassSubjectTeacher::where(
            'class_id',
            $schoolClass->id
        )
            ->where(
                'subject_id',
                $subject->id
            )
            ->exists();

        abort_unless($assignmentExists, 404);


        // Get teachers
        $teachers = Teacher::orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        // Get students of this class
        $students = Student::where(
            'class_id',
            $schoolClass->id
        )
            ->with([
                'marks' => function ($query) use ($subject) {

                    $query->where(
                        'subject_id',
                        $subject->id
                    )
                        ->with([
                            'exam',
                            'teacher'
                        ]);
                }
            ])
            ->paginate(12)
            ->withQueryString();


        return view('marks.index', compact(
            'schoolClass',
            'subject',
            'students',
            'teachers'
        ));
    }


    public function store(
        Request $request,
        SchoolClass $schoolClass,
        Subject $subject
    ) {
        $request->validate([
            'teacher_id' => [
                'required',
                'exists:teachers,id',
            ],

            'marks' => [
                'required',
                'array',
            ],

            'marks.*.midterm' => [
                'nullable',
                'integer',
                'min:0',
                'max:40',
            ],

            'marks.*.annual' => [
                'nullable',
                'integer',
                'min:0',
                'max:60',
            ],
        ]);


        // Check that the subject is assigned to this class
        $assignmentExists = ClassSubjectTeacher::where(
            'class_id',
            $schoolClass->id
        )
            ->where(
                'subject_id',
                $subject->id
            )
            ->exists();

        abort_unless($assignmentExists, 404);


        // Make sure all submitted students belong to this class
        $studentIds = Student::where(
            'class_id',
            $schoolClass->id
        )
            ->whereIn(
                'id',
                array_keys($request->marks)
            )
            ->pluck('id')
            ->toArray();

        abort_unless(
            count($studentIds) === count($request->marks),
            404
        );


        // Get active academic year
        $academicYear = AcademicYear::where(
            'is_active',
            true
        )->firstOrFail();


        // Get exams for active academic year
        $exams = Exam::where(
            'academic_year',
            $academicYear->name
        )
            ->whereIn('type', [
                'midterm',
                'annual',
            ])
            ->get()
            ->keyBy('type');


        // Make sure both exams exist
        abort_unless(
            $exams->has('midterm') &&
                $exams->has('annual'),
            404
        );


        // Save marks inside a transaction
        DB::transaction(function () use (
            $request,
            $subject,
            $exams
        ) {

            foreach (
                $request->marks as $studentId => $studentMarks
            ) {

                // Midterm mark
                if (
                    isset($studentMarks['midterm']) &&
                    $studentMarks['midterm'] !== null &&
                    $studentMarks['midterm'] !== ''
                ) {

                    Mark::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'subject_id' => $subject->id,
                            'exam_id' => $exams['midterm']->id,
                        ],
                        [
                            'teacher_id' => $request->teacher_id,
                            'marks' => $studentMarks['midterm'],
                        ]
                    );
                }


                // Annual mark
                if (
                    isset($studentMarks['annual']) &&
                    $studentMarks['annual'] !== null &&
                    $studentMarks['annual'] !== ''
                ) {

                    Mark::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'subject_id' => $subject->id,
                            'exam_id' => $exams['annual']->id,
                        ],
                        [
                            'teacher_id' => $request->teacher_id,
                            'marks' => $studentMarks['annual'],
                        ]
                    );
                }
            }
        });


        return redirect()
            ->route('marks.index', [
                'schoolClass' => $schoolClass->id,
                'subject' => $subject->id,
            ])
            ->with(
                'success',
                'Marks saved successfully.'
            );
    }
}
