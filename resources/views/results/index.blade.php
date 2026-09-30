@extends('layouts.app')

@section('title', 'Result Report')

@section('content')

<div class="container-fluid mt-4 px-3">

    ```
    {{-- =========================================
     PAGE HEADER
========================================== --}}

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
            class="btn btn-secondary btn-sm">

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </a>

    </div>


    {{-- =========================================
     RESULT CARD
========================================== --}}

    <div class="card shadow-sm border-0">

        <div class="card-body p-2">

            <div class="table-responsive">

                <table class="table result-table mb-0">

                    {{-- =========================================
                     TABLE HEADER
                ========================================== --}}

                    <thead>

                        <tr>

                            {{-- No --}}
                            <th class="number-header">
                                No
                            </th>


                            {{-- Student --}}
                            <th class="student-header">
                                Student
                            </th>


                            {{-- Subjects --}}
                            @foreach ($subjects as $subject)

                            <th class="subject-header">
                                {{ $subject->name }}
                            </th>

                            @endforeach


                            {{-- Total --}}
                            <th class="overall-header">
                                Total
                            </th>


                            {{-- Percentage --}}
                            <th class="overall-header">
                                %
                            </th>


                            {{-- Grade --}}
                            <th class="overall-header">
                                Grade
                            </th>


                            {{-- Result --}}
                            <th class="overall-header">
                                Result
                            </th>

                        </tr>

                    </thead>


                    {{-- =========================================
                     TABLE BODY
                ========================================== --}}

                    <tbody>

                        @forelse ($results as $result)

                        @php

                        $subjectResults = collect(
                        $result['subjects']
                        )->values();


                        /*
                        |--------------------------------------------------------------------------
                        | Exam 1
                        |--------------------------------------------------------------------------
                        */

                        $overallMidterm = 0;

                        $midtermMaximum = 0;


                        /*
                        |--------------------------------------------------------------------------
                        | Exam 2
                        |--------------------------------------------------------------------------
                        */

                        $overallAnnual = 0;

                        $annualMaximum = 0;


                        /*
                        |--------------------------------------------------------------------------
                        | Total
                        |--------------------------------------------------------------------------
                        */

                        $overallTotal = 0;


                        foreach ($subjectResults as $studentSubject) {

                        $midterm =
                        $studentSubject['midterm']
                        ?? null;

                        $annual =
                        $studentSubject['annual']
                        ?? null;


                        /*
                        |--------------------------------------------------------------------------
                        | First Exam
                        |--------------------------------------------------------------------------
                        */

                        if (
                        $midterm !== null &&
                        $midterm !== ''
                        ) {

                        $overallMidterm +=
                        (float) $midterm;

                        $midtermMaximum += 40;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Second Exam
                        |--------------------------------------------------------------------------
                        */

                        if (
                        $annual !== null &&
                        $annual !== ''
                        ) {

                        $overallAnnual +=
                        (float) $annual;

                        $annualMaximum += 60;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Subject Total
                        |--------------------------------------------------------------------------
                        */

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

                        $subjectTotal = 0;


                        if (
                        $midterm !== null &&
                        $midterm !== ''
                        ) {

                        $subjectTotal +=
                        (float) $midterm;

                        }


                        if (
                        $annual !== null &&
                        $annual !== ''
                        ) {

                        $subjectTotal +=
                        (float) $annual;

                        }


                        $overallTotal +=
                        $subjectTotal;

                        }

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | First Exam Percentage
                        |--------------------------------------------------------------------------
                        */

                        $midtermPercentage = null;


                        if ($midtermMaximum > 0) {

                        $midtermPercentage = round(
                        (
                        $overallMidterm /
                        $midtermMaximum
                        ) * 100,
                        2
                        );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Second Exam Percentage
                        |--------------------------------------------------------------------------
                        */

                        $annualPercentage = null;


                        if ($annualMaximum > 0) {

                        $annualPercentage = round(
                        (
                        $overallAnnual /
                        $annualMaximum
                        ) * 100,
                        2
                        );

                        }

                        @endphp


                        {{-- ==================================================
                             ROW 1 - FIRST EXAM
                        =================================================== --}}

                        <tr>

                            {{-- No --}}
                            <td
                                rowspan="3"
                                class="student-number">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Student --}}
                            <td
                                rowspan="3"
                                class="student-name">

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


                            {{-- First Exam Total --}}
                            <td class="grand-total-cell">

                                @if ($midtermMaximum > 0)

                                {{ $overallMidterm }}

                                @endif

                            </td>


                            {{-- First Exam Percentage --}}
                            <td class="summary-cell">

                                @if ($midtermPercentage !== null)

                                {{ $midtermPercentage }}%

                                @endif

                            </td>


                            {{-- Grade --}}
                            <td
                                rowspan="3"
                                class="summary-cell grade-cell">

                                {{ $result['grade'] ?? '' }}

                            </td>


                            {{-- Result --}}
                            <td
                                rowspan="3"
                                class="summary-cell">

                                @if ($result['result'] === 'Pass')

                                <span class="badge bg-success">
                                    Pass
                                </span>

                                @elseif ($result['result'] === 'Fail')

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

                            {{-- Subject Second Exam --}}
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


                            {{-- Second Exam Total --}}
                            <td class="grand-total-cell">

                                @if ($annualMaximum > 0)

                                {{ $overallAnnual }}

                                @endif

                            </td>


                            {{-- Second Exam Percentage --}}
                            <td class="summary-cell">

                                @if ($annualPercentage !== null)

                                {{ $annualPercentage }}%

                                @endif

                            </td>

                        </tr>


                        {{-- ==================================================
                             ROW 3 - TOTAL
                        =================================================== --}}

                        <tr class="student-end">

                            {{-- Subject Total --}}
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

                                @if ($midtermMaximum > 0 || $annualMaximum > 0)

                                {{ $overallTotal }}

                                @endif

                            </td>


                            {{-- Total Percentage --}}
                            <td class="summary-cell">

                                @if ($result['percentage'] !== null)

                                {{ $result['percentage'] }}%

                                @endif

                            </td>

                        </tr>


                        @empty

                        <tr>

                            <td
                                colspan="{{ 6 + $subjects->count() }}"
                                class="text-center text-muted py-5">

                                <i
                                    class="bi bi-journal-x fs-3 d-block mb-2"></i>

                                No students found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =========================================
             PAGINATION
        ========================================== --}}

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
    ```

</div>

{{-- =========================================
RESULT TABLE CSS
========================================== --}}

<style>
    .result-table {

        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;

        table-layout: fixed;

        text-align: center;

        font-size: 12px;

    }


    /* =========================================
       ALL CELLS
    ========================================== */

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

        font-size: 11px;

        font-weight: 700;

        text-align: center !important;

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

        font-size: 11px;

    }


    .student-header {

        text-align: center !important;

        font-weight: 600;

        background-color: #f8f9fa;

    }


    .student-name {

        text-align: center !important;

        font-weight: 600;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    /* =========================================
       SUBJECT HEADER
       Vertical subject names
    ========================================== */

    .subject-header {

        width: 35px;
        min-width: 35px;
        max-width: 35px;

        height: 100px;

        padding: 3px 2px !important;

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

        height: 20px;

        padding: 1px !important;

        font-size: 11px;

        line-height: 1;

        font-weight: 500;

        text-align: center !important;

        vertical-align: middle !important;

        background-color: #ffffff;

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

        height: 20px;

        padding: 1px !important;

        font-size: 11px;

        line-height: 1;

        font-weight: 600;

        text-align: center !important;

        vertical-align: middle !important;

    }


    /* =========================================
       OVERALL HEADERS
    ========================================== */

    .overall-header {

        width: 50px;
        min-width: 50px;
        max-width: 50px;

        font-size: 10px;

        font-weight: 600;

        text-align: center !important;

        background-color: #f8f9fa;

    }


    /* =========================================
       SUMMARY
    ========================================== */

    .summary-cell {

        width: 50px;
        min-width: 50px;
        max-width: 50px;

        padding: 2px !important;

        font-size: 10px;

        line-height: 1.1;

        text-align: center !important;

        vertical-align: middle !important;

    }


    /* =========================================
       GRADE
    ========================================== */

    .grade-cell {

        font-size: 11px;

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

        padding: 2px 4px !important;

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

            font-size: 10px;

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

            height: 20px;

            font-size: 10px;

        }


        .number-header,
        .student-number {

            width: 32px;
            min-width: 32px;
            max-width: 32px;

            font-size: 10px;

        }


        .overall-header,
        .grand-total-cell,
        .summary-cell {

            width: 45px;
            min-width: 45px;
            max-width: 45px;

            font-size: 9px;

        }


        .result-table tbody tr {

            height: 20px;

        }

    }
</style>

@endsection