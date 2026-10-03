<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">


<title>Student Result</title>

<style>
    @page {
        margin: 25px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        color: #222;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .school-name {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .report-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .academic-year {
        font-size: 11px;
        color: #555;
    }

    .student-info {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .student-info td {
        border: 1px solid #999;
        padding: 7px;
    }

    .label {
        font-weight: bold;
        background: #f1f3f5;
        width: 18%;
    }

    .result-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .result-table th,
    .result-table td {
        border: 1px solid #777;
        padding: 7px 5px;
        text-align: center;
    }

    .result-table th {
        background: #e9ecef;
        font-weight: bold;
    }

    .subject-name {
        text-align: left !important;
    }

    .total-row {
        font-weight: bold;
        background: #f1f3f5;
    }

    .summary {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .summary td {
        border: 1px solid #999;
        padding: 8px;
        text-align: center;
    }

    .summary-label {
        font-weight: bold;
        background: #f1f3f5;
    }

    .pass {
        color: #198754;
        font-weight: bold;
    }

    .fail {
        color: #dc3545;
        font-weight: bold;
    }

    .footer {
        margin-top: 45px;
        width: 100%;
    }

    .signature {
        width: 45%;
        display: inline-block;
        text-align: center;
    }

    .signature-line {
        border-top: 1px solid #555;
        margin: 35px auto 5px;
        width: 150px;
    }
</style>
```

</head>

<body>

```
{{-- =========================================
     HEADER
========================================== --}}

<div class="header">

    <div class="school-name">
        School Management System
    </div>

    <div class="report-title">
        Student Result Report
    </div>

    <div class="academic-year">
        Academic Year: {{ $academicYear->name }}
    </div>

</div>


{{-- =========================================
     STUDENT INFORMATION
========================================== --}}

<table class="student-info">

    <tr>
        <td class="label">
            Student Name
        </td>

        <td>
            {{ $student->first_name }}
            {{ $student->last_name }}
        </td>

        <td class="label">
            Admission No
        </td>

        <td>
            {{ $student->admission_no }}
        </td>
    </tr>

    <tr>
        <td class="label">
            Father Name
        </td>

        <td>
            {{ $student->father_name }}
        </td>

        <td class="label">
            Class
        </td>

        <td>
            {{ $schoolClass->name }}
            @if ($schoolClass->section)
                - {{ $schoolClass->section }}
            @endif
        </td>
    </tr>

</table>


{{-- =========================================
     RESULT TABLE
========================================== --}}

<table class="result-table">

    <thead>

        <tr>

            <th width="7%">
                No
            </th>

            <th width="35%">
                Subject
            </th>

            <th width="15%">
                Midterm
                <br>
                /40
            </th>

            <th width="15%">
                Annual
                <br>
                /60
            </th>

            <th width="14%">
                Total
                <br>
                /100
            </th>

            <th width="14%">
                Grade
            </th>

        </tr>

    </thead>


    <tbody>

        @foreach ($studentSubjects as $studentSubject)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td class="subject-name">
                    {{ $studentSubject['subject']->name }}
                </td>

                <td>
                    @if (
                        $studentSubject['midterm'] !== null &&
                        $studentSubject['midterm'] !== ''
                    )
                        {{ $studentSubject['midterm'] }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if (
                        $studentSubject['annual'] !== null &&
                        $studentSubject['annual'] !== ''
                    )
                        {{ $studentSubject['annual'] }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if ($studentSubject['has_mark'])
                        {{ $studentSubject['total'] }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if ($studentSubject['has_mark'])

                        @php
                            $subjectTotal = (float) $studentSubject['total'];

                            if ($subjectTotal >= 90) {
                                $subjectGrade = 'A';
                            } elseif ($subjectTotal >= 80) {
                                $subjectGrade = 'B';
                            } elseif ($subjectTotal >= 70) {
                                $subjectGrade = 'C';
                            } elseif ($subjectTotal >= 60) {
                                $subjectGrade = 'D';
                            } elseif ($subjectTotal >= 50) {
                                $subjectGrade = 'E';
                            } else {
                                $subjectGrade = 'F';
                            }
                        @endphp

                        {{ $subjectGrade }}

                    @else
                        -
                    @endif
                </td>

            </tr>

        @endforeach


        {{-- =========================================
             TOTAL ROW
        ========================================== --}}

        <tr class="total-row">

            <td colspan="2">
                Overall Total
            </td>

            <td>
                {{ $studentSubjects->sum(function ($item) {
                    return $item['midterm'] !== null &&
                        $item['midterm'] !== ''
                        ? (float) $item['midterm']
                        : 0;
                }) }}
            </td>

            <td>
                {{ $studentSubjects->sum(function ($item) {
                    return $item['annual'] !== null &&
                        $item['annual'] !== ''
                        ? (float) $item['annual']
                        : 0;
                }) }}
            </td>

            <td>
                {{ $totalMarks }}
            </td>

            <td>
                {{ $grade ?? '-' }}
            </td>

        </tr>

    </tbody>

</table>


{{-- =========================================
     FINAL SUMMARY
========================================== --}}

<table class="summary">

    <tr>

        <td class="summary-label">
            Total Marks
        </td>

        <td>
            {{ $totalMarks }}
            /
            {{ $maximumMarks }}
        </td>

        <td class="summary-label">
            Percentage
        </td>

        <td>
            @if ($percentage !== null)
                {{ $percentage }}%
            @else
                -
            @endif
        </td>

    </tr>

    <tr>

        <td class="summary-label">
            Grade
        </td>

        <td>
            {{ $grade ?? '-' }}
        </td>

        <td class="summary-label">
            Result
        </td>

        <td>

            @if ($result === 'Pass')

                <span class="pass">
                    PASS
                </span>

            @elseif ($result === 'Fail')

                <span class="fail">
                    FAIL
                </span>

            @else

                -

            @endif

        </td>

    </tr>

</table>


{{-- =========================================
     SIGNATURES
========================================== --}}

<div class="footer">

    <div class="signature">

        <div class="signature-line"></div>

        Class Teacher

    </div>


    <div class="signature">

        <div class="signature-line"></div>

        Principal

    </div>

</div>


</body>

</html>
