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
        | Exams
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
        | Marks
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
        | Build Result Data
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

                        $subjectMarks = $marks
                            ->get(
                                $student->id,
                                collect()
                            )
                            ->get(
                                $subject->id,
                                collect()
                            );


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
                        | Subject Total
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
                */

                $totalMarks = 0;
                $maximumMarks = 0;


                foreach ($studentSubjects as $studentSubject) {

                    if ($studentSubject['has_mark']) {

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


    /*
    |--------------------------------------------------------------------------
    | Individual Student PDF
    |--------------------------------------------------------------------------
    */

    public function pdf(
        SchoolClass $schoolClass,
        Student $student
    ) {

        /*
        |--------------------------------------------------------------------------
        | Make sure student belongs to selected class
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $student->class_id === $schoolClass->id,
            404
        );


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
        | Subjects
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
        | Exams
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
        | Student Marks
        |--------------------------------------------------------------------------
        */

        $marks = Mark::where(
            'student_id',
            $student->id
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
            ->groupBy('subject_id');


        /*
        |--------------------------------------------------------------------------
        | Build Student Result
        |--------------------------------------------------------------------------
        */

        $studentSubjects = $subjects->map(
            function ($subject) use (
                $marks,
                $exams
            ) {

                $subjectMarks = $marks->get(
                    $subject->id,
                    collect()
                );


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
                | Subject Total
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
        | Overall Result
        |--------------------------------------------------------------------------
        */

        $totalMarks = 0;
        $maximumMarks = 0;


        foreach ($studentSubjects as $studentSubject) {

            if ($studentSubject['has_mark']) {

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
        | Individual PDF
        |--------------------------------------------------------------------------
        | Keep DomPDF because this PDF is already working.
        |--------------------------------------------------------------------------
        */

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'results.pdf',
            [
                'student' => $student,
                'schoolClass' => $schoolClass,
                'academicYear' => $academicYear,
                'studentSubjects' => $studentSubjects,
                'totalMarks' => $totalMarks,
                'maximumMarks' => $maximumMarks,
                'percentage' => $percentage,
                'grade' => $grade,
                'result' => $result,
            ]
        );


        return $pdf->stream(
            'result-' .
            $student->first_name .
            '-' .
            $student->last_name .
            '.pdf'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Class-wide Result PDF
    |--------------------------------------------------------------------------
    | mPDF is used here because this PDF contains many students and subjects.
    |--------------------------------------------------------------------------
    */

    public function classPdf(SchoolClass $schoolClass)
    {
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
        | Exams
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
        | All students of this class
        |--------------------------------------------------------------------------
        */

        $students = Student::where(
            'class_id',
            $schoolClass->id
        )
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Marks
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
        | Build Student Results
        |--------------------------------------------------------------------------
        */

        $results = [];


        foreach ($students as $student) {

            $studentSubjects = [];

            $totalMarks = 0;

            $maximumMarks = 0;


            foreach ($subjects as $subject) {

                $midterm = null;

                $annual = null;


                /*
                |--------------------------------------------------------------------------
                | Get Student Subject Marks
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
                | Midterm
                |--------------------------------------------------------------------------
                */

                if ($exams->has('midterm')) {

                    $mark = $subjectMarks
                        ->firstWhere(
                            'exam_id',
                            $exams['midterm']->id
                        );

                    if ($mark) {
                        $midterm = $mark->marks;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Annual
                |--------------------------------------------------------------------------
                */

                if ($exams->has('annual')) {

                    $mark = $subjectMarks
                        ->firstWhere(
                            'exam_id',
                            $exams['annual']->id
                        );

                    if ($mark) {
                        $annual = $mark->marks;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Check Marks
                |--------------------------------------------------------------------------
                */

                $hasMidterm =
                    $midterm !== null &&
                    $midterm !== '';

                $hasAnnual =
                    $annual !== null &&
                    $annual !== '';

                $hasMark =
                    $hasMidterm ||
                    $hasAnnual;


                /*
                |--------------------------------------------------------------------------
                | Subject Total
                |--------------------------------------------------------------------------
                */

                $subjectTotal = null;


                if ($hasMark) {

                    $subjectTotal = 0;


                    if ($hasMidterm) {

                        $subjectTotal +=
                            (float) $midterm;
                    }


                    if ($hasAnnual) {

                        $subjectTotal +=
                            (float) $annual;
                    }


                    $totalMarks +=
                        $subjectTotal;

                    $maximumMarks += 100;
                }


                /*
                |--------------------------------------------------------------------------
                | Store Subject Result
                |--------------------------------------------------------------------------
                */

                $studentSubjects[$subject->id] = [

                    'subject' => $subject,

                    'midterm' => $midterm,

                    'annual' => $annual,

                    'total' => $subjectTotal,

                    'has_mark' => $hasMark,

                ];
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
            | Store Student Result
            |--------------------------------------------------------------------------
            */

            $results[] = [

                'student' => $student,

                'subjects' => $studentSubjects,

                'totalMarks' => $totalMarks,

                'maximumMarks' => $maximumMarks,

                'percentage' => $percentage,

                'grade' => $grade,

                'result' => $result,

            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Render Blade View
        |--------------------------------------------------------------------------
        */

        $html = view(
            'results.class-pdf',
            [
                'schoolClass' => $schoolClass,

                'academicYear' => $academicYear,

                'subjects' => $subjects,

                'results' => $results,
            ]
        )->render();


        /*
        |--------------------------------------------------------------------------
        | Generate PDF with mPDF
        |--------------------------------------------------------------------------
        */

        $mpdf = new \Mpdf\Mpdf([

            'format' => 'A4-L',

            'margin_left' => 5,

            'margin_right' => 5,

            'margin_top' => 6,

            'margin_bottom' => 6,

            'margin_header' => 0,

            'margin_footer' => 0,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Write HTML
        |--------------------------------------------------------------------------
        */

        $mpdf->WriteHTML($html);


        /*
        |--------------------------------------------------------------------------
        | Stream PDF
        |--------------------------------------------------------------------------
        */

        return response(
            $mpdf->Output(
                'class-result-' .
                $schoolClass->name .
                '.pdf',
                'S'
            )
        )
            ->header(
                'Content-Type',
                'application/pdf'
            )
            ->header(
                'Content-Disposition',
                'inline; filename="class-result-' .
                $schoolClass->name .
                '.pdf"'
            );
    }
}