@extends('layouts.app')

@section('title', 'Marks')

@section('content')

<div class="container-fluid mt-4 px-4">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="mb-1">Marks</h1>

        <div class="text-muted">
            {{ $schoolClass->name }}

            @if ($schoolClass->section)
                - {{ $schoolClass->section }}
            @endif

            |
            {{ $subject->name }}
        </div>
    </div>

    <a href="{{ url('/classes') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Back

    </a>

</div>


{{-- Success Message --}}
@if (session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- Validation Errors --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- Marks Card --}}
<div class="card shadow-sm">

    <div class="card-body">

        <form
            id="marksForm"
            method="POST"
            action="{{ route('marks.store', [
                'schoolClass' => $schoolClass->id,
                'subject' => $subject->id,
            ]) }}"
        >

            @csrf


            {{-- Teacher --}}
            @php

                $selectedTeacherId = old(
                    'teacher_id',
                    $students->first()?->marks
                        ->first()?->teacher_id
                );

            @endphp


            <div class="row mb-4">

                <div class="col-md-4">

                    <label class="form-label">
                        Teacher
                    </label>

                    <select
                        name="teacher_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Teacher
                        </option>

                        @foreach ($teachers as $teacher)

                            <option
                                value="{{ $teacher->id }}"
                                {{ $selectedTeacherId == $teacher->id ? 'selected' : '' }}
                            >

                                {{ $teacher->first_name }}
                                {{ $teacher->last_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- Marks Table --}}
            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-light">

                        <tr>

                            <th style="width: 70px;">
                                No
                            </th>

                            <th>
                                Student
                            </th>

                            <th>
                                Midterm
                                <small class="text-muted">
                                    / 40
                                </small>
                            </th>

                            <th>
                                Annual
                                <small class="text-muted">
                                    / 60
                                </small>
                            </th>

                            <th>
                                Total
                                <small class="text-muted">
                                    / 100
                                </small>
                            </th>

                            <th>
                                Grade
                            </th>

                            <th>
                                Result
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($students as $student)

                            @php

                                $midtermMark = $student->marks
                                    ->firstWhere(
                                        'exam.type',
                                        'midterm'
                                    )
                                    ?->marks;

                                $annualMark = $student->marks
                                    ->firstWhere(
                                        'exam.type',
                                        'annual'
                                    )
                                    ?->marks;

                                $totalMark =
                                    ($midtermMark ?? 0)
                                    +
                                    ($annualMark ?? 0);

                                $hasMarks =
                                    $midtermMark !== null ||
                                    $annualMark !== null;

                                $grade = null;
                                $result = null;

                                if ($hasMarks) {

                                    if ($totalMark >= 90) {
                                        $grade = 'A';
                                    } elseif ($totalMark >= 80) {
                                        $grade = 'B';
                                    } elseif ($totalMark >= 70) {
                                        $grade = 'C';
                                    } elseif ($totalMark >= 60) {
                                        $grade = 'D';
                                    } elseif ($totalMark >= 50) {
                                        $grade = 'E';
                                    } else {
                                        $grade = 'F';
                                    }

                                    $result =
                                        $totalMark >= 40
                                            ? 'Pass'
                                            : 'Fail';
                                }

                            @endphp


                            <tr>

                                {{-- No --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- Student --}}
                                <td>
                                    {{ $student->first_name }}
                                    {{ $student->last_name }}
                                </td>


                                {{-- Midterm --}}
                                <td>

                                    <input
                                        type="number"
                                        name="marks[{{ $student->id }}][midterm]"
                                        class="form-control midterm-mark"
                                        min="0"
                                        max="40"
                                        step="1"
                                        placeholder="0 - 40"
                                        value="{{ old(
                                            'marks.' . $student->id . '.midterm',
                                            $midtermMark
                                        ) }}"
                                    >

                                    <div class="text-danger small mt-1 midterm-error"></div>

                                </td>


                                {{-- Annual --}}
                                <td>

                                    <input
                                        type="number"
                                        name="marks[{{ $student->id }}][annual]"
                                        class="form-control annual-mark"
                                        min="0"
                                        max="60"
                                        step="1"
                                        placeholder="0 - 60"
                                        value="{{ old(
                                            'marks.' . $student->id . '.annual',
                                            $annualMark
                                        ) }}"
                                    >

                                    <div class="text-danger small mt-1 annual-error"></div>

                                </td>


                                {{-- Total --}}
                                <td>

                                    <input
                                        type="text"
                                        class="form-control total-mark"
                                        value="{{ $hasMarks ? $totalMark : '' }}"
                                        placeholder="—"
                                        readonly
                                    >

                                </td>


                                {{-- Grade --}}
                                <td>

                                    <input
                                        type="text"
                                        class="form-control grade-mark"
                                        value="{{ $grade ?? '' }}"
                                        placeholder="—"
                                        readonly
                                    >

                                </td>


                                {{-- Result --}}
                                <td>

                                    <input
                                        type="text"
                                        class="form-control result-mark"
                                        value="{{ $result ?? '' }}"
                                        placeholder="—"
                                        readonly
                                    >

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center text-muted py-4"
                                >

                                    No students found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($students->hasPages())

                <div class="mt-3">
                    {{ $students->links() }}
                </div>

            @endif


            {{-- Save Button --}}
            @if ($students->count() > 0)

                <div class="text-end mt-3">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save me-1"></i>
                        Save Marks

                    </button>

                </div>

            @endif

        </form>

    </div>

</div>
```

</div>

{{-- Total, Grade, Result and Input Validation --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('marksForm');

    const rows = document.querySelectorAll('tbody tr');


    rows.forEach(function (row) {

        const midtermInput =
            row.querySelector('.midterm-mark');

        const annualInput =
            row.querySelector('.annual-mark');

        const totalInput =
            row.querySelector('.total-mark');

        const gradeInput =
            row.querySelector('.grade-mark');

        const resultInput =
            row.querySelector('.result-mark');

        const midtermError =
            row.querySelector('.midterm-error');

        const annualError =
            row.querySelector('.annual-error');


        if (
            !midtermInput ||
            !annualInput ||
            !totalInput ||
            !gradeInput ||
            !resultInput
        ) {
            return;
        }


        function validateMarks() {

            let hasError = false;


            /* =========================
               Midterm
            ========================= */

            if (midtermInput.value !== '') {

                let value =
                    Number(midtermInput.value);

                if (value > 40) {

                    midtermInput.value = 40;

                    midtermInput.classList.add('is-invalid');

                    midtermError.textContent =
                        'Midterm marks must be between 0 - 40.';

                    hasError = true;

                } else if (value < 0) {

                    midtermInput.value = 0;

                    midtermInput.classList.add('is-invalid');

                    midtermError.textContent =
                        'Midterm marks must be between 0 - 40.';

                    hasError = true;

                } else {

                    midtermInput.classList.remove('is-invalid');

                    midtermError.textContent = '';

                }

            } else {

                midtermInput.classList.remove('is-invalid');

                midtermError.textContent = '';

            }


            /* =========================
               Annual
            ========================= */

            if (annualInput.value !== '') {

                let value =
                    Number(annualInput.value);

                if (value > 60) {

                    annualInput.value = 60;

                    annualInput.classList.add('is-invalid');

                    annualError.textContent =
                        'Annual marks must be between 0 - 60.';

                    hasError = true;

                } else if (value < 0) {

                    annualInput.value = 0;

                    annualInput.classList.add('is-invalid');

                    annualError.textContent =
                        'Annual marks must be between 0 - 60.';

                    hasError = true;

                } else {

                    annualInput.classList.remove('is-invalid');

                    annualError.textContent = '';

                }

            } else {

                annualInput.classList.remove('is-invalid');

                annualError.textContent = '';

            }


            return hasError;

        }


        function calculateResult() {

            validateMarks();


            const midtermValue =
                midtermInput.value.trim();

            const annualValue =
                annualInput.value.trim();


            if (
                midtermValue === '' &&
                annualValue === ''
            ) {

                totalInput.value = '';
                gradeInput.value = '';
                resultInput.value = '';

                return;

            }


            const midterm =
                Number(midtermValue) || 0;

            const annual =
                Number(annualValue) || 0;


            const total =
                midterm + annual;


            totalInput.value = total;


            let grade = 'F';


            if (total >= 90) {

                grade = 'A';

            } else if (total >= 80) {

                grade = 'B';

            } else if (total >= 70) {

                grade = 'C';

            } else if (total >= 60) {

                grade = 'D';

            } else if (total >= 50) {

                grade = 'E';

            }


            gradeInput.value = grade;


            resultInput.value =
                total >= 40
                    ? 'Pass'
                    : 'Fail';

        }


        midtermInput.addEventListener(
            'input',
            calculateResult
        );

        annualInput.addEventListener(
            'input',
            calculateResult
        );


        calculateResult();

    });


    /* =========================
       Prevent Submit on Invalid Marks
    ========================= */

    if (form) {

        form.addEventListener('submit', function (event) {

            let hasError = false;


            rows.forEach(function (row) {

                const midtermInput =
                    row.querySelector('.midterm-mark');

                const annualInput =
                    row.querySelector('.annual-mark');


                if (!midtermInput || !annualInput) {
                    return;
                }


                const midterm =
                    Number(midtermInput.value);

                const annual =
                    Number(annualInput.value);


                if (
                    midtermInput.value !== '' &&
                    (midterm < 0 || midterm > 40)
                ) {

                    hasError = true;

                }


                if (
                    annualInput.value !== '' &&
                    (annual < 0 || annual > 60)
                ) {

                    hasError = true;

                }

            });


            if (hasError) {

                event.preventDefault();

            }

        });

    }

});

</script>

@endsection
