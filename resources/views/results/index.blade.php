@extends('layouts.app')

@section('title', 'Result Report')

@section('content')

<div class="container-fluid mt-4 px-3">


{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h1 class="mb-1">
            Result Report
        </h1>

        <div class="text-muted small">
            {{ $schoolClass->name }}

            @if ($schoolClass->section)
                - {{ $schoolClass->section }}
            @endif
        </div>

    </div>

    <a
        href="{{ route('classes.index') }}"
        class="btn btn-secondary btn-sm"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Back
    </a>

</div>


{{-- Result Card --}}
<div class="card shadow-sm border-0">

    <div class="card-body p-2">

        <div class="table-responsive">

            <table class="table result-table mb-0">

                {{-- =========================
                     TABLE HEADER
                ========================== --}}
                <thead>

                    <tr>

                        <th class="number-header">
                            No
                        </th>

                        <th class="student-header">
                            Student
                        </th>


                        {{-- Subjects --}}
                        @foreach ($subjects as $subject)

                            <th class="subject-header">
                                {{ $subject->name }}
                            </th>

                        @endforeach


                        <th class="overall-header">
                            Total
                        </th>

                        <th class="overall-header">
                            %
                        </th>

                        <th class="overall-header">
                            Grade
                        </th>

                        <th class="overall-header">
                            Result
                        </th>

                    </tr>

                </thead>


                {{-- =========================
                     TABLE BODY
                ========================== --}}
                <tbody>

                    @forelse ($results as $result)

                        @php

                            $subjectResults = collect(
                                $result['subjects']
                            )->values();


                            /*
                            |--------------------------------------------------------------------------
                            | Calculate only entered marks
                            |--------------------------------------------------------------------------
                            */

                            $overallMidterm = 0;
                            $overallAnnual = 0;
                            $overallTotal = 0;

                            $overallMaximum = 0;


                            foreach ($subjectResults as $studentSubject) {

                                $midterm =
                                    $studentSubject['midterm'] ?? null;

                                $annual =
                                    $studentSubject['annual'] ?? null;


                                /*
                                | Midterm is counted only
                                | when a value exists.
                                */

                                if (
                                    $midterm !== null &&
                                    $midterm !== ''
                                ) {

                                    $overallMidterm += (float) $midterm;

                                    $overallMaximum += 40;

                                }


                                /*
                                | Annual is counted only
                                | when a value exists.
                                */

                                if (
                                    $annual !== null &&
                                    $annual !== ''
                                ) {

                                    $overallAnnual += (float) $annual;

                                    $overallMaximum += 60;

                                }


                                /*
                                | Subject total
                                */

                                $subjectTotal = 0;

                                if (
                                    $midterm !== null &&
                                    $midterm !== ''
                                ) {

                                    $subjectTotal += (float) $midterm;

                                }

                                if (
                                    $annual !== null &&
                                    $annual !== ''
                                ) {

                                    $subjectTotal += (float) $annual;

                                }

                                if (
                                    (
                                        $midterm !== null &&
                                        $midterm !== ''
                                    )
                                    ||
                                    (
                                        $annual !== null &&
                                        $annual !== ''
                                    )
                                ) {

                                    $overallTotal += $subjectTotal;

                                }

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | Percentage
                            |--------------------------------------------------------------------------
                            */

                            $percentage = null;

                            if ($overallMaximum > 0) {

                                $percentage = round(
                                    ($overallTotal / $overallMaximum) * 100,
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
                            | Result
                            |--------------------------------------------------------------------------
                            */

                            $finalResult = null;

                            if ($percentage !== null) {

                                $finalResult =
                                    $percentage >= 40
                                        ? 'Pass'
                                        : 'Fail';

                            }

                        @endphp


                        {{-- ==================================================
                             ROW 1 - FIRST EXAM
                        =================================================== --}}
                        <tr>

                            {{-- No --}}
                            <td
                                rowspan="3"
                                class="student-number"
                            >

                                {{ $loop->iteration }}

                            </td>


                            {{-- Student --}}
                            <td
                                rowspan="3"
                                class="student-name"
                            >

                                {{ $result['student']->first_name }}

                                {{ $result['student']->last_name }}

                            </td>


                            {{-- Subject First Exam --}}
                            @foreach ($subjectResults as $studentSubject)

                                @php

                                    $midterm =
                                        $studentSubject['midterm']
                                        ?? null;

                                @endphp

                                <td class="mark-cell">

                                    @if (
                                        $midterm !== null &&
                                        $midterm !== ''
                                    )

                                        {{ $midterm }}

                                    @endif

                                </td>

                            @endforeach


                            {{-- Grand Total First Exam --}}
                            <td class="grand-total-cell">

                                @if ($overallMaximum > 0)

                                    {{ $overallMidterm }}

                                @endif

                            </td>


                            {{-- Percentage --}}
                            <td
                                rowspan="3"
                                class="summary-cell"
                            >

                                @if ($percentage !== null)

                                    {{ $percentage }}%

                                @endif

                            </td>


                            {{-- Grade --}}
                            <td
                                rowspan="3"
                                class="summary-cell grade-cell"
                            >

                                {{ $grade ?? '' }}

                            </td>


                            {{-- Result --}}
                            <td
                                rowspan="3"
                                class="summary-cell"
                            >

                                @if ($finalResult === 'Pass')

                                    <span class="badge bg-success">
                                        Pass
                                    </span>

                                @elseif ($finalResult === 'Fail')

                                    <span class="badge bg-danger">
                                        Fail
                                    </span>

                                @endif

                            </td>

                        </tr>


                        {{-- ==================================================
                             ROW 2 - SECOND EXAM
                        =================================================== --}}
                        <tr>

                            @foreach ($subjectResults as $studentSubject)

                                @php

                                    $annual =
                                        $studentSubject['annual']
                                        ?? null;

                                @endphp

                                <td class="mark-cell">

                                    @if (
                                        $annual !== null &&
                                        $annual !== ''
                                    )

                                        {{ $annual }}

                                    @endif

                                </td>

                            @endforeach


                            {{-- Grand Total Second Exam --}}
                            <td class="grand-total-cell">

                                @if ($overallMaximum > 0)

                                    {{ $overallAnnual }}

                                @endif

                            </td>

                        </tr>


                        {{-- ==================================================
                             ROW 3 - TOTAL
                        =================================================== --}}
                        <tr class="student-end">

                            @foreach ($subjectResults as $studentSubject)

                                @php

                                    $midterm =
                                        $studentSubject['midterm']
                                        ?? null;

                                    $annual =
                                        $studentSubject['annual']
                                        ?? null;


                                    $hasMidterm =
                                        $midterm !== null &&
                                        $midterm !== '';

                                    $hasAnnual =
                                        $annual !== null &&
                                        $annual !== '';

                                    $hasAnyMark =
                                        $hasMidterm ||
                                        $hasAnnual;


                                    $subjectTotal = 0;


                                    if ($hasMidterm) {

                                        $subjectTotal +=
                                            (float) $midterm;

                                    }


                                    if ($hasAnnual) {

                                        $subjectTotal +=
                                            (float) $annual;

                                    }

                                @endphp


                                <td class="mark-cell total-cell">

                                    @if ($hasAnyMark)

                                        {{ $subjectTotal }}

                                    @endif

                                </td>

                            @endforeach


                            {{-- Grand Total --}}
                            <td class="grand-total-cell total-cell">

                                @if ($overallMaximum > 0)

                                    {{ $overallTotal }}

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="{{ 6 + $subjects->count() }}"
                                class="text-center text-muted py-5"
                            >

                                <i
                                    class="bi bi-journal-x fs-3 d-block mb-2"
                                ></i>

                                No students found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($students->hasPages())

            <div class="d-flex justify-content-between align-items-center mt-3">

                <div class="text-muted small">

                    Showing
                    {{ $students->firstItem() }}
                    to
                    {{ $students->lastItem() }}
                    of
                    {{ $students->total() }}
                    students

                </div>

                <div>

                    {{ $students->links() }}

                </div>

            </div>

        @endif

    </div>

</div>


</div>

{{-- =========================
RESULT TABLE CSS
========================== --}}

<style>

    /* =========================================
       TABLE
    ========================================== */

    .result-table {

        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;

        table-layout: fixed;

        font-size: 12px;

    }


    .result-table th,
    .result-table td {

        border: 1px solid #adb5bd !important;

        padding: 2px !important;

        text-align: center;

        vertical-align: middle !important;

    }


    /* =========================================
       NUMBER
    ========================================== */

    .number-header,
    .student-number {

        width: 35px;
        min-width: 35px;
        max-width: 35px;

        text-align: center !important;

        font-size: 11px;

        font-weight: 700;

        background-color: #f8f9fa;

    }


    /* =========================================
       STUDENT
    ========================================== */

    .student-header,
    .student-name {

        width: 100px;
        min-width: 100px;
        max-width: 100px;

        text-align: center !important;

        font-size: 11px;

    }


    .student-name {

        font-weight: 600;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    /* =========================================
       SUBJECT HEADER
    ========================================== */

    .subject-header {

        width: 35px;
        min-width: 35px;
        max-width: 35px;

        height: 100px;

        padding: 3px !important;

        writing-mode: vertical-rl;

        transform: rotate(180deg);

        text-align: center !important;

        vertical-align: middle !important;

        white-space: nowrap;

        font-size: 10px;

        font-weight: 600;

        background-color: #f1f3f5;

    }


    /* =========================================
       MARK CELLS
    ========================================== */

    .mark-cell {

        width: 35px;
        min-width: 35px;
        max-width: 35px;

        height: 32px;

        padding: 1px !important;

        font-size: 11px;

        text-align: center !important;

    }


    /* =========================================
       TOTAL
    ========================================== */

    .total-cell {

        font-weight: 700;

        background-color: #f8f9fa;

    }


    .grand-total-cell {

        width: 55px;
        min-width: 55px;
        max-width: 55px;

        height: 32px;

        padding: 1px !important;

        font-size: 11px;

        font-weight: 600;

        text-align: center !important;

    }


    /* =========================================
       SUMMARY
    ========================================== */

    .overall-header {

        width: 50px;
        min-width: 50px;
        max-width: 50px;

        font-size: 10px;

        font-weight: 600;

        background-color: #f8f9fa;

    }


    .summary-cell {

        width: 50px;
        min-width: 50px;
        max-width: 50px;

        padding: 2px !important;

        font-size: 10px;

        text-align: center !important;

        vertical-align: middle !important;

    }


    .grade-cell {

        font-weight: 700;

    }


    /* =========================================
       STUDENT SEPARATOR
    ========================================== */

    .student-end td {

        border-bottom: 3px solid #6c757d !important;

    }


    /* =========================================
       RESULT BADGE
    ========================================== */

    .result-table .badge {

        font-size: 8px;

        padding: 3px 4px !important;

        border-radius: 3px;

    }


    /* =========================================
       MOBILE
    ========================================== */

    @media (max-width: 768px) {

        .result-table {

            font-size: 10px;

        }


        .student-header,
        .student-name {

            width: 85px;
            min-width: 85px;
            max-width: 85px;

        }


        .subject-header {

            width: 32px;
            min-width: 32px;
            max-width: 32px;

            height: 95px;

            font-size: 9px;

        }


        .mark-cell {

            width: 32px;
            min-width: 32px;
            max-width: 32px;

            height: 30px;

            font-size: 10px;

        }


        .number-header,
        .student-number {

            width: 32px;
            min-width: 32px;
            max-width: 32px;

        }


        .overall-header,
        .grand-total-cell,
        .summary-cell {

            width: 45px;
            min-width: 45px;
            max-width: 45px;

            font-size: 9px;

        }

    }

</style>

@endsection
