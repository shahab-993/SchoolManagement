<?php

namespace App\Http\Controllers;

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
        // Students of this class
        $students = Student::where(
            'class_id',
            $schoolClass->id
        )
            ->paginate(12)
            ->withQueryString();


        // Subjects assigned to this class
        $subjectIds = ClassSubjectTeacher::where(
            'class_id',
            $schoolClass->id
        )
            ->pluck('subject_id')
            ->unique();


        $subjects = Subject::whereIn(
            'id',
            $subjectIds
        )
            ->orderBy('name')
            ->get();


        // Exams of current academic year
        $exams = Exam::where(
            'academic_year',
            '2026-2027'
        )
            ->whereIn('type', [
                'midterm',
                'annual'
            ])
            ->get()
            ->keyBy('type');


        // Marks of students on current page
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
                'subject_id'
            ]);


        // Build result data
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

                        $subjectMarks = $marks
                            ->get(
                                $student->id,
                                collect()
                            )
                            ->get(
                                $subject->id,
                                collect()
                            );


                        $midterm = 0;
                        $annual = 0;


                        if ($exams->has('midterm')) {

                            $midtermMark = $subjectMarks
                                ->firstWhere(
                                    'exam_id',
                                    $exams['midterm']->id
                                );

                            $midterm =
                                $midtermMark?->marks ?? 0;
                        }


                        if ($exams->has('annual')) {

                            $annualMark = $subjectMarks
                                ->firstWhere(
                                    'exam_id',
                                    $exams['annual']->id
                                );

                            $annual =
                                $annualMark?->marks ?? 0;
                        }


                        $total = $midterm + $annual;


                        return [
                            'subject' => $subject,
                            'midterm' => $midterm,
                            'annual' => $annual,
                            'total' => $total,
                        ];

                    }
                );


                $totalMarks =
                    $studentSubjects->sum('total');


                $maximumMarks =
                    $studentSubjects->count() * 100;


                $percentage = $maximumMarks > 0
                    ? ($totalMarks / $maximumMarks) * 100
                    : 0;


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


                $result = $percentage >= 40
                    ? 'Pass'
                    : 'Fail';


                return [
                    'student' => $student,
                    'subjects' => $studentSubjects,
                    'total_marks' => $totalMarks,
                    'maximum_marks' => $maximumMarks,
                    'percentage' => round(
                        $percentage,
                        2
                    ),
                    'grade' => $grade,
                    'result' => $result,
                ];

            }
        );


        return view('results.index', compact(
            'schoolClass',
            'subjects',
            'results',
            'students'
        ));
    }
}
