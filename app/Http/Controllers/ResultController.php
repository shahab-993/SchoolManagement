<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassSubjectTeacher;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;

class ResultController extends Controller
{
    public function index(SchoolClass $schoolClass)
    {
        /*
        |--------------------------------------------------------------------------
        | Students of this class
        |--------------------------------------------------------------------------
        */

        $students = Student::where(
            'class_id',
            $schoolClass->id
        )
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Subjects assigned to this class
        |--------------------------------------------------------------------------
        */

        $subjectIds = ClassSubjectTeacher::where(
            'class_id',
            $schoolClass->id
        )
            ->pluck('subject_id')
            ->unique()
            ->values();


        $subjects = Subject::whereIn(
            'id',
            $subjectIds
        )
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Active Academic Year
        |--------------------------------------------------------------------------
        */

        $academicYear = AcademicYear::where(
            'is_active',
            true
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Exams of active academic year
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Get marks of students on current page
        |--------------------------------------------------------------------------
        */

        $marks = Mark::whereIn(
            'student_id',
            $students->pluck('id')
        )
            ->whereIn(
                'subject_id',
                $subjectIds
            )
            ->whereIn(
                'exam_id',
                $exams->pluck('id')
            )
            ->get()
            ->groupBy([
                'student_id',
                'subject_id',
            ]);


        /*
        |--------------------------------------------------------------------------
        | Build result data
        |--------------------------------------------------------------------------
        */

        $results = $students->getCollection()->map(
            function ($student) use (
                $subjects,
                $marks,
                $exams
            ) {

                $studentSubjects = $subjects->map(
                    function ($subject) use (
                        $student,
                        $marks,
                        $exams
                    ) {

                        /*
                        |--------------------------------------------------------------------------
                        | Get this student's marks for this subject
                        |--------------------------------------------------------------------------
                        */

                        $subjectMarks = $marks
                            ->get(
                                $student->id,
                                collect()
                            )
                            ->get(
                                $subject->id,
                                collect()
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | Start with NULL
                        |
                        | NULL = no mark entered
                        | 0    = actual mark of zero
                        |--------------------------------------------------------------------------
                        */

                        $midterm = null;
                        $annual = null;


                        /*
                        |--------------------------------------------------------------------------
                        | Midterm
                        |--------------------------------------------------------------------------
                        */

                        if ($exams->has('midterm')) {

                            $midtermMark = $subjectMarks
                                ->firstWhere(
                                    'exam_id',
                                    $exams['midterm']->id
                                );


                            if ($midtermMark !== null) {

                                $midterm = $midtermMark->marks;

                            }
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Annual
                        |--------------------------------------------------------------------------
                        */

                        if ($exams->has('annual')) {

                            $annualMark = $subjectMarks
                                ->firstWhere(
                                    'exam_id',
                                    $exams['annual']->id
                                );


                            if ($annualMark !== null) {

                                $annual = $annualMark->marks;

                            }
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Check if this subject has any mark
                        |--------------------------------------------------------------------------
                        */

                        $hasMidterm =
                            $midterm !== null &&
                            $midterm !== '';

                        $hasAnnual =
                            $annual !== null &&
                            $annual !== '';


                        $hasAnyMark =
                            $hasMidterm ||
                            $hasAnnual;


                        /*
                        |--------------------------------------------------------------------------
                        | Subject Total
                        |--------------------------------------------------------------------------
                        */

                        $total = null;


                        if ($hasAnyMark) {

                            $total = 0;


                            if ($hasMidterm) {

                                $total += (float) $midterm;

                            }


                            if ($hasAnnual) {

                                $total += (float) $annual;

                            }

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Return subject result
                        |--------------------------------------------------------------------------
                        */

                        return [
                            'subject' => $subject,

                            'midterm' => $midterm,

                            'annual' => $annual,

                            'total' => $total,

                            'has_mark' => $hasAnyMark,
                        ];

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Overall Calculation
                |--------------------------------------------------------------------------
                |
                | Only subjects with at least one entered mark
                | are included.
                |
                */

                $totalMarks = 0;

                $maximumMarks = 0;


                foreach ($studentSubjects as $studentSubject) {

                    if (
                        !empty($studentSubject['has_mark'])
                    ) {

                        $totalMarks +=
                            (float) $studentSubject['total'];

                        $maximumMarks += 100;

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Percentage
                |--------------------------------------------------------------------------
                */

                $percentage = null;


                if ($maximumMarks > 0) {

                    $percentage = round(
                        (
                            $totalMarks /
                            $maximumMarks
                        ) * 100,
                        2
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Grade
                |--------------------------------------------------------------------------
                */

                $grade = null;


                if ($percentage !== null) {

                    if ($percentage >= 90) {

                        $grade = 'A';

                    } elseif ($percentage >= 80) {

                        $grade = 'B';

                    } elseif ($percentage >= 70) {

                        $grade = 'C';

                    } elseif ($percentage >= 60) {

                        $grade = 'D';

                    } elseif ($percentage >= 50) {

                        $grade = 'E';

                    } else {

                        $grade = 'F';

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Final Result
                |--------------------------------------------------------------------------
                */

                $result = null;


                if ($percentage !== null) {

                    $result =
                        $percentage >= 40
                            ? 'Pass'
                            : 'Fail';

                }


                /*
                |--------------------------------------------------------------------------
                | Return complete student result
                |--------------------------------------------------------------------------
                */

                return [

                    'student' => $student,

                    'subjects' => $studentSubjects,

                    'total_marks' => $totalMarks,

                    'maximum_marks' => $maximumMarks,

                    'percentage' => $percentage,

                    'grade' => $grade,

                    'result' => $result,

                ];

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Send data to view
        |--------------------------------------------------------------------------
        */

        return view(
            'results.index',
            compact(
                'schoolClass',
                'subjects',
                'results',
                'students'
            )
        );
    }
}
