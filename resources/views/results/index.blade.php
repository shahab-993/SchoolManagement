@extends('layouts.app')

@section('title', 'Result Report')

@section('content')

<div class="container-fluid mt-4 px-3">

    {{-- =========================================
         PAGE HEADER
    ========================================== --}}

    <div class="result-page-header mb-4">

        <div>
            <h1 class="result-page-title mb-1">
                Result Report
            </h1>

            <div class="result-class-info">
                <i class="bi bi-mortarboard-fill me-1"></i>

                {{ $schoolClass->name }}

                @if ($schoolClass->section)
                    <span class="mx-1">•</span>
                    Section {{ $schoolClass->section }}
                @endif
            </div>
        </div>

        <a
            href="{{ route('classes.index') }}"
            class="btn btn-secondary btn-sm result-back-btn">

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </a>

    </div>


    {{-- =========================================
         RESULT CARD
    ========================================== --}}

    <div class="card result-card border-0">

        {{-- CARD HEADER --}}

        <div class="result-card-header">

            <div>
                <h5 class="mb-1">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    Student Results
                </h5>

                <div class="result-card-subtitle">
                    Academic performance overview
                </div>
            </div>

            <div class="student-count">

                <i class="bi bi-people-fill me-1"></i>

                {{ $students->total() }}

                Students

            </div>

        </div>


        {{-- TABLE --}}

        <div class="card-body p-0">

            <div class="table-responsive result-table-wrapper">

                <table class="table result-table mb-0">

                    {{-- =========================================
                         TABLE HEADER
                    ========================================== --}}

                    <thead>

                        <tr>

                            <th class="number-header">
                                No
                            </th>

                            <th class="student-header">
                                Student
                            </th>


                            {{-- SUBJECTS --}}

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

                            <th class="overall-header result-header">
                                Result
                            </th>

                            <th class="action-header">
                                Action
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
                                | MIDTERM
                                |--------------------------------------------------------------------------
                                */

                                $overallMidterm = 0;

                                $midtermMaximum = 0;


                                /*
                                |--------------------------------------------------------------------------
                                | ANNUAL
                                |--------------------------------------------------------------------------
                                */

                                $overallAnnual = 0;

                                $annualMaximum = 0;


                                /*
                                |--------------------------------------------------------------------------
                                | TOTAL
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
                                    | MIDTERM
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
                                    | ANNUAL
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
                                    | SUBJECT TOTAL
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
                                | MIDTERM PERCENTAGE
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
                                | ANNUAL PERCENTAGE
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
                                 ROW 1 - MIDTERM
                            =================================================== --}}

                            <tr class="student-first-row">

                                {{-- NUMBER --}}

                                <td
                                    rowspan="3"
                                    class="student-number">

                                    <div class="student-number-box">
                                        {{ $loop->iteration }}
                                    </div>

                                </td>


                                {{-- STUDENT --}}

                                <td
                                    rowspan="3"
                                    class="student-name">

                                    <div class="student-name-wrapper">

                                        <div class="student-name-text">

                                            {{ $result['student']->first_name }}

                                            {{ $result['student']->last_name }}

                                        </div>

                                        <div class="student-exam-label">
                                            Midterm / Annual
                                        </div>

                                    </div>

                                </td>


                                {{-- SUBJECT MIDTERM --}}

                                @foreach ($subjectResults as $studentSubject)

                                    @php

                                        $midterm =
                                            $studentSubject['midterm']
                                            ?? null;

                                    @endphp

                                    <td class="mark-cell midterm-cell">

                                        @if (
                                            $midterm !== null &&
                                            $midterm !== ''
                                        )

                                            {{ $midterm }}

                                        @else

                                            <span class="empty-mark">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                @endforeach


                                {{-- MIDTERM TOTAL --}}

                                <td class="grand-total-cell">

                                    @if ($midtermMaximum > 0)

                                        {{ $overallMidterm }}

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- MIDTERM PERCENTAGE --}}

                                <td class="summary-cell">

                                    @if ($midtermPercentage !== null)

                                        {{ $midtermPercentage }}%

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- GRADE --}}

                                <td
                                    rowspan="3"
                                    class="summary-cell grade-cell">

                                    @if ($result['grade'])

                                        <span class="grade-badge">
                                            {{ $result['grade'] }}
                                        </span>

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- RESULT --}}

                                <td
                                    rowspan="3"
                                    class="summary-cell">

                                    @if ($result['result'] === 'Pass')

                                        <span class="result-badge result-pass">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Pass
                                        </span>

                                    @elseif ($result['result'] === 'Fail')

                                        <span class="result-badge result-fail">
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                            Fail
                                        </span>

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}

                                <td
                                    rowspan="3"
                                    class="action-cell">

                                    @if (
                                        auth()->user()->hasPermission(
                                            'print_results'
                                        )
                                    )

                                        <a
                                            href="{{ route('results.pdf', [
                                                'schoolClass' => $schoolClass->id,
                                                'student' => $result['student']->id,
                                            ]) }}"
                                            target="_blank"
                                            class="print-result-btn"
                                            title="Print Student Result">

                                            <i class="bi bi-file-earmark-pdf-fill"></i>

                                            <span>
                                                Print PDF
                                            </span>

                                        </a>

                                    @endif

                                </td>

                            </tr>


                            {{-- ==================================================
                                 ROW 2 - ANNUAL
                            =================================================== --}}

                            <tr class="student-second-row">

                                @foreach ($subjectResults as $studentSubject)

                                    @php

                                        $annual =
                                            $studentSubject['annual']
                                            ?? null;

                                    @endphp

                                    <td class="mark-cell annual-cell">

                                        @if (
                                            $annual !== null &&
                                            $annual !== ''
                                        )

                                            {{ $annual }}

                                        @else

                                            <span class="empty-mark">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                @endforeach


                                {{-- ANNUAL TOTAL --}}

                                <td class="grand-total-cell">

                                    @if ($annualMaximum > 0)

                                        {{ $overallAnnual }}

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- ANNUAL PERCENTAGE --}}

                                <td class="summary-cell">

                                    @if ($annualPercentage !== null)

                                        {{ $annualPercentage }}%

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

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

                                        @else

                                            <span class="empty-mark">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                @endforeach


                                {{-- GRAND TOTAL --}}

                                <td class="grand-total-cell total-cell">

                                    @if (
                                        $midtermMaximum > 0 ||
                                        $annualMaximum > 0
                                    )

                                        {{ $overallTotal }}

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- TOTAL PERCENTAGE --}}

                                <td class="summary-cell total-percentage">

                                    @if ($result['percentage'] !== null)

                                        {{ $result['percentage'] }}%

                                    @else

                                        <span class="empty-mark">
                                            -
                                        </span>

                                    @endif

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="{{ 7 + $subjects->count() }}"
                                    class="empty-results">

                                    <i
                                        class="bi bi-journal-x">
                                    </i>

                                    <div>
                                        No students found.
                                    </div>

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

                <div class="pagination-wrapper">

                    <div class="text-muted small">

                        Showing
                        <strong>{{ $students->firstItem() }}</strong>
                        to
                        <strong>{{ $students->lastItem() }}</strong>
                        of
                        <strong>{{ $students->total() }}</strong>
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


{{-- =========================================================
     RESULT PAGE CSS
========================================================= --}}

<style>

    /* =========================================
       PAGE HEADER
    ========================================== */

    .result-page-header {

        display: flex;

        justify-content: space-between;

        align-items: center;

        padding: 18px 20px;

        background: #ffffff;

        border: 1px solid #e9ecef;

        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

    }


    .result-page-title {

        font-size: 24px;

        font-weight: 700;

        color: #263b52;

    }


    .result-class-info {

        color: #6c757d;

        font-size: 13px;

    }


    .result-back-btn {

        border-radius: 6px;

        padding: 6px 12px;

    }


    /* =========================================
       RESULT CARD
    ========================================== */

    .result-card {

        border-radius: 10px;

        overflow: hidden;

        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);

    }


    .result-card-header {

        display: flex;

        justify-content: space-between;

        align-items: center;

        padding: 15px 18px;

        background: #f8f9fa;

        border-bottom: 1px solid #dee2e6;

    }


    .result-card-header h5 {

        color: #263b52;

        font-weight: 700;

        margin: 0;

        font-size: 16px;

    }


    .result-card-subtitle {

        font-size: 11px;

        color: #6c757d;

    }


    .student-count {

        font-size: 12px;

        color: #6c757d;

        background: #ffffff;

        border: 1px solid #dee2e6;

        padding: 5px 9px;

        border-radius: 6px;

    }


    /* =========================================
       TABLE WRAPPER
    ========================================== */

    .result-table-wrapper {

        width: 100%;

        overflow-x: auto;

        overflow-y: hidden;

    }


    /* =========================================
       TABLE
    ========================================== */

    .result-table {

        width: 100%;

        min-width: 900px;

        border-collapse: collapse;

        border-spacing: 0;

        table-layout: fixed;

        text-align: center;

        font-size: 12px;

        margin: 0;

    }


    .result-table th,
    .result-table td {

        border: 1px solid #d9dee3 !important;

        padding: 3px !important;

        text-align: center;

        vertical-align: middle !important;

    }


    /* =========================================
       TABLE HEADER
    ========================================== */

    .result-table thead th {

        background: #263b52;

        color: #ffffff;

        font-weight: 600;

        border-color: #263b52 !important;

    }


    /* =========================================
       NUMBER
    ========================================== */

    .number-header,
    .student-number {

        width: 42px;

        min-width: 42px;

        max-width: 42px;

    }


    .number-header {

        font-size: 11px;

    }


    .student-number {

        background: #f8fafc;

    }


    .student-number-box {

        width: 25px;

        height: 25px;

        margin: auto;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #e9eef3;

        color: #263b52;

        border-radius: 50%;

        font-size: 11px;

        font-weight: 700;

    }


    /* =========================================
       STUDENT
    ========================================== */

    .student-header,
    .student-name {

        width: 125px;

        min-width: 125px;

        max-width: 125px;

    }


    .student-header {

        font-size: 11px;

    }


    .student-name {

        background: #f8fafc;

    }


    .student-name-wrapper {

        padding: 2px 4px;

    }


    .student-name-text {

        font-size: 11px;

        font-weight: 700;

        color: #263b52;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    .student-exam-label {

        margin-top: 3px;

        font-size: 8px;

        color: #8a949e;

        text-transform: uppercase;

        letter-spacing: .3px;

    }


    /* =========================================
       SUBJECT HEADERS
    ========================================== */

    .subject-header {

        width: 38px;

        min-width: 38px;

        max-width: 38px;

        height: 105px;

        padding: 3px 2px !important;

        writing-mode: vertical-rl;

        transform: rotate(180deg);

        text-align: center !important;

        vertical-align: middle !important;

        white-space: nowrap;

        font-size: 9px;

        font-weight: 600;

    }


    /* =========================================
       MARK CELLS
    ========================================== */

    .mark-cell {

        width: 38px;

        min-width: 38px;

        max-width: 38px;

        height: 22px;

        padding: 2px !important;

        font-size: 11px;

        line-height: 1;

        text-align: center !important;

        vertical-align: middle !important;

    }


    .midterm-cell {

        background: #ffffff;

    }


    .annual-cell {

        background: #f8fafc;

    }


    .total-cell {

        background: #eef2f5;

        font-weight: 700;

        color: #263b52;

    }


    .empty-mark {

        color: #adb5bd;

    }


    /* =========================================
       OVERALL COLUMNS
    ========================================== */

    .overall-header {

        width: 55px;

        min-width: 55px;

        max-width: 55px;

        font-size: 10px;

    }


    .grand-total-cell {

        width: 55px;

        min-width: 55px;

        max-width: 55px;

        font-weight: 600;

        color: #263b52;

    }


    .summary-cell {

        width: 55px;

        min-width: 55px;

        max-width: 55px;

        font-size: 10px;

    }


    .total-percentage {

        font-weight: 700;

        color: #263b52;

    }


    /* =========================================
       GRADE
    ========================================== */

    .grade-cell {

        font-size: 12px;

        font-weight: 700;

    }


    .grade-badge {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        width: 28px;

        height: 28px;

        border-radius: 50%;

        background: #e8eef4;

        color: #263b52;

        font-weight: 700;

    }


    /* =========================================
       RESULT
    ========================================== */

    .result-header {

        width: 65px;

        min-width: 65px;

        max-width: 65px;

    }


    .result-badge {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 4px 7px;

        border-radius: 5px;

        font-size: 9px;

        font-weight: 600;

        white-space: nowrap;

    }


    .result-pass {

        background: #e8f5ee;

        color: #198754;

    }


    .result-fail {

        background: #fdebec;

        color: #dc3545;

    }


    /* =========================================
       ACTION
    ========================================== */

    .action-header {

        width: 90px;

        min-width: 90px;

        max-width: 90px;

        font-size: 10px;

    }


    .action-cell {

        width: 90px;

        min-width: 90px;

        max-width: 90px;

        background: #ffffff;

    }


    .print-result-btn {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 4px;

        padding: 5px 7px;

        border-radius: 5px;

        background: #3d5f7e;

        color: #ffffff;

        border: 1px solid #263b52;

        text-decoration: none;

        font-size: 9px;

        font-weight: 500;

        white-space: nowrap;

        transition: all .2s ease;

    }


    .print-result-btn:hover {

        background: #344d68;

        border-color: #344d68;

        color: #ffffff;

        transform: translateY(-1px);

    }


    .print-result-btn i {

        font-size: 11px;

    }


    /* =========================================
       STUDENT ROWS
    ========================================== */

    .student-first-row td {

        border-top: 2px solid #adb5bd !important;

    }


    .student-second-row td {

        border-top: 0 !important;

        border-bottom: 0 !important;

    }


    .student-end td {

        border-bottom: 3px solid #adb5bd !important;

    }


    /* =========================================
       EMPTY STATE
    ========================================== */

    .empty-results {

        padding: 50px 20px !important;

        color: #6c757d;

        font-size: 14px;

    }


    .empty-results i {

        display: block;

        font-size: 35px;

        margin-bottom: 10px;

        color: #adb5bd;

    }


    /* =========================================
       PAGINATION
    ========================================== */

    .pagination-wrapper {

        display: flex;

        justify-content: space-between;

        align-items: center;

        padding: 15px 18px;

        border-top: 1px solid #e9ecef;

        background: #ffffff;

    }


    /* =========================================
       MOBILE
    ========================================== */

    @media (max-width: 768px) {

        .result-page-header {

            padding: 13px;

        }


        .result-page-title {

            font-size: 20px;

        }


        .result-class-info {

            font-size: 11px;

        }


        .result-card-header {

            padding: 12px;

        }


        .student-count {

            font-size: 10px;

            padding: 4px 6px;

        }


        .result-table {

            min-width: 850px;

            font-size: 10px;

        }


        .student-header,
        .student-name {

            width: 100px;

            min-width: 100px;

            max-width: 100px;

        }


        .student-name-text {

            font-size: 10px;

        }


        .subject-header {

            width: 32px;

            min-width: 32px;

            max-width: 32px;

            height: 95px;

            font-size: 8px;

        }


        .mark-cell {

            width: 32px;

            min-width: 32px;

            max-width: 32px;

            height: 20px;

            font-size: 9px;

        }


        .number-header,
        .student-number {

            width: 35px;

            min-width: 35px;

            max-width: 35px;

        }


        .overall-header,
        .grand-total-cell,
        .summary-cell {

            width: 45px;

            min-width: 45px;

            max-width: 45px;

            font-size: 9px;

        }


        .action-header,
        .action-cell {

            width: 55px;

            min-width: 55px;

            max-width: 55px;

        }


        .print-result-btn {

            width: 30px;

            height: 27px;

            padding: 3px;

        }


        .print-result-btn span {

            display: none;

        }


        .print-result-btn i {

            font-size: 13px;

        }


        .grade-badge {

            width: 24px;

            height: 24px;

            font-size: 10px;

        }


        .pagination-wrapper {

            flex-direction: column;

            gap: 10px;

            align-items: flex-start;

        }

    }

</style>

@endsection