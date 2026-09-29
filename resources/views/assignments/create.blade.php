@extends('layouts.app')

@section('title', 'Assign Class Subjects')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Assign Class Subjects</h2>

            <p class="text-muted mb-0">
                Assign subjects to a class.
            </p>

        </div>

        <a href="{{ route('assignments.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </a>

    </div>


    {{-- Assignment Form --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('assignments.store') }}"
                method="POST"
            >

                @csrf


                {{-- Class --}}
                <div class="mb-4">

                    <label
                        for="classSelect"
                        class="form-label"
                    >
                        Class
                    </label>

                    <select
                        name="class_id"
                        id="classSelect"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Class
                        </option>

                        @foreach ($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                {{ old('class_id') == $class->id ? 'selected' : '' }}
                            >

                                {{ $class->name }}

                                @if ($class->section)
                                    - {{ $class->section }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('class_id')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Subject Search --}}
                <div class="mb-3">

                    <label class="form-label">
                        Subjects
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="search"
                            id="subjectSearch"
                            class="form-control"
                            placeholder="Search subject..."
                        >

                    </div>

                </div>


                {{-- Selected Class Subjects --}}
                <div
                    id="selectedSubjectsSection"
                    class="d-none"
                >

                    <div
                        class="d-flex align-items-center gap-2 mb-3"
                    >

                        <i class="bi bi-check-circle-fill text-success"></i>

                        <h5 class="mb-0">
                            Subjects for Selected Class
                        </h5>

                    </div>


                    <div
                        id="selectedSubjects"
                        class="row"
                    >
                    </div>

                </div>


                {{-- Divider --}}
                <div
                    id="subjectDivider"
                    class="d-none my-4"
                >

                    <hr>

                </div>


                {{-- Available Subjects --}}
                <div id="availableSubjects">

                    @php

                        $groupedSubjects = $subjects
                            ->groupBy('grade');

                    @endphp


                    @forelse ($groupedSubjects as $grade => $gradeSubjects)

                        <div
                            class="subject-grade-group mb-4"
                            data-grade="{{ $grade }}"
                        >

                            <div
                                class="d-flex align-items-center mb-3"
                            >

                                <div
                                    class="border-start border-3 border-primary ps-3"
                                >

                                    <h5 class="mb-0">
                                        {{ $grade }}
                                    </h5>

                                    <small class="text-muted">
                                        Available Subjects
                                    </small>

                                </div>

                            </div>


                            <div class="row">

                                @foreach ($gradeSubjects as $subject)

                                    <div
                                        class="col-md-6 col-lg-4 mb-2 subject-item"
                                        data-grade="{{ $grade }}"
                                        data-subject-id="{{ $subject->id }}"
                                    >

                                        <div class="form-check">

                                            <input
                                                class="form-check-input subject-checkbox"
                                                type="checkbox"
                                                name="subject_id[]"
                                                value="{{ $subject->id }}"
                                                id="subject{{ $subject->id }}"

                                                {{ in_array(
                                                    $subject->id,
                                                    old('subject_id', [])
                                                ) ? 'checked' : '' }}
                                            >

                                            <label
                                                class="form-check-label"
                                                for="subject{{ $subject->id }}"
                                            >

                                                {{ $subject->name }}

                                                @if ($subject->code)

                                                    <span class="text-muted">
                                                        - {{ $subject->code }}
                                                    </span>

                                                @endif

                                            </label>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @empty

                        <div class="text-center text-muted py-4">

                            No subjects found.

                        </div>

                    @endforelse

                </div>


                {{-- Validation Error --}}
                @error('subject_id')

                    <div class="text-danger small mb-3">
                        {{ $message }}
                    </div>

                @enderror


                {{-- Submit --}}
                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-circle me-1"></i>
                    Assign Subjects

                </button>

            </form>

        </div>

    </div>

</div>


{{-- Load Selected Class Subjects --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const classSelect =
        document.getElementById('classSelect');

    const selectedSection =
        document.getElementById(
            'selectedSubjectsSection'
        );

    const selectedContainer =
        document.getElementById(
            'selectedSubjects'
        );

    const divider =
        document.getElementById(
            'subjectDivider'
        );

    const availableSubjects =
        document.getElementById(
            'availableSubjects'
        );

    const subjectItems =
        document.querySelectorAll(
            '.subject-item'
        );


    /*
    |--------------------------------------------------------------------------
    | Store original parent of every subject
    |--------------------------------------------------------------------------
    */

    subjectItems.forEach(function (item) {

        item.dataset.originalParent =
            item.parentElement.className;

    });


    /*
    |--------------------------------------------------------------------------
    | Find original grade group
    |--------------------------------------------------------------------------
    */

    function getOriginalGroup(item) {

        const grade =
            item.dataset.grade;

        return document.querySelector(
            `.subject-grade-group[data-grade="${grade}"] .row`
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Show / Hide selected section
    |--------------------------------------------------------------------------
    */

    function updateSelectedSection() {

        const selectedItems =
            document.querySelectorAll(
                '#selectedSubjects .subject-item'
            );

        if (selectedItems.length > 0) {

            selectedSection.classList.remove('d-none');

            divider.classList.remove('d-none');

        } else {

            selectedSection.classList.add('d-none');

            divider.classList.add('d-none');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Load subjects assigned to selected class
    |--------------------------------------------------------------------------
    */

    function loadAssignedSubjects(classId) {

        // Return all subjects to their original grade groups
        subjectItems.forEach(function (item) {

            const originalGroup =
                getOriginalGroup(item);

            if (originalGroup) {

                originalGroup.appendChild(item);

            }

        });


        // Uncheck everything
        subjectItems.forEach(function (item) {

            const checkbox =
                item.querySelector(
                    '.subject-checkbox'
                );

            if (checkbox) {

                checkbox.checked = false;

            }

        });


        selectedContainer.innerHTML = '';


        if (!classId) {

            updateSelectedSection();

            return;

        }


        fetch(
            `/classes/${classId}/assigned-subjects`
        )
            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'Failed to load subjects.'
                    );

                }

                return response.json();

            })
            .then(function (subjectIds) {

                subjectItems.forEach(function (item) {

                    const checkbox =
                        item.querySelector(
                            '.subject-checkbox'
                        );

                    if (!checkbox) {
                        return;
                    }


                    const subjectId =
                        Number(checkbox.value);


                    if (
                        subjectIds.includes(subjectId)
                    ) {

                        checkbox.checked = true;

                        selectedContainer.appendChild(
                            item
                        );

                    }

                });


                updateSelectedSection();

            })
            .catch(function (error) {

                console.error(error);

            });

    }


    /*
    |--------------------------------------------------------------------------
    | Class change
    |--------------------------------------------------------------------------
    */

    classSelect.addEventListener(
        'change',
        function () {

            loadAssignedSubjects(
                this.value
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Load subjects when page opens
    |--------------------------------------------------------------------------
    */

    if (classSelect.value) {

        loadAssignedSubjects(
            classSelect.value
        );

    }

});

</script>

@endsection