@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid dashboard-page">

{{-- =========================
     Dashboard Header
========================== --}}

<div class="dashboard-header">

    <div>

        <h1 class="dashboard-title">
            Dashboard
        </h1>

        <p class="dashboard-subtitle">
            Welcome back! Here is your school overview.
        </p>

    </div>

    <div class="dashboard-date">

        <i class="bi bi-calendar3"></i>

        School Management

    </div>

</div>


{{-- =========================
     Statistics Cards
========================== --}}

<div class="row g-4">

    {{-- Students --}}
    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-stat-card students-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Total Students
                    </p>

                    <h2 class="stat-number">
                        {{ $studentCount }}
                    </h2>

                    <p class="stat-description">

                        <i class="bi bi-arrow-up"></i>

                        Active students

                    </p>

                </div>

                <div class="stat-icon students-icon">

                    <i class="bi bi-people-fill"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Teachers --}}
    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-stat-card teachers-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Total Teachers
                    </p>

                    <h2 class="stat-number">
                        {{ $teacherCount }}
                    </h2>

                    <p class="stat-description">

                        <i class="bi bi-check-circle-fill"></i>

                        Active teachers

                    </p>

                </div>

                <div class="stat-icon teachers-icon">

                    <i class="bi bi-person-workspace"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Classes --}}
    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-stat-card classes-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Total Classes
                    </p>

                    <h2 class="stat-number">
                        {{ $classCount }}
                    </h2>

                    <p class="stat-description">

                        <i class="bi bi-building"></i>

                        School classes

                    </p>

                </div>

                <div class="stat-icon classes-icon">

                    <i class="bi bi-building-fill"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Subjects --}}
    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-stat-card subjects-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Total Subjects
                    </p>

                    <h2 class="stat-number">
                        {{ $subjectCount }}
                    </h2>

                    <p class="stat-description">

                        <i class="bi bi-book-fill"></i>

                        Available subjects

                    </p>

                </div>

                <div class="stat-icon subjects-icon">

                    <i class="bi bi-journal-bookmark-fill"></i>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     Welcome & Quick Access
========================== --}}

<div class="row g-4 mt-1">

    {{-- Welcome Card --}}
    <div class="col-12 col-lg-8">

        <div class="dashboard-welcome-card">

            <div class="welcome-content">

                <div class="welcome-icon">

                    <i class="bi bi-mortarboard-fill"></i>

                </div>

                <div class="welcome-text">

                    <span class="welcome-small-title">
                        Welcome to your dashboard
                    </span>

                    <h4>
                        School Management System
                    </h4>

                    <p>
                        Manage students, teachers, classes and
                        subjects from one simple dashboard.
                    </p>

                </div>

            </div>

            <div class="welcome-decoration">

                <i class="bi bi-bar-chart-fill"></i>

            </div>

        </div>

    </div>


    {{-- Quick Access --}}
    <div class="col-12 col-lg-4">

        <div class="quick-card">

            <div class="quick-card-header">

                <div>

                    <span class="quick-small-title">
                        Shortcuts
                    </span>

                    <h5>
                        Quick Access
                    </h5>

                </div>

                <div class="quick-header-icon">

                    <i class="bi bi-lightning-charge-fill"></i>

                </div>

            </div>


            <div class="quick-links">

                <a href="{{ route('classes.index') }}">

                    <div class="quick-link-icon classes-link-icon">

                        <i class="bi bi-building"></i>

                    </div>

                    <div class="quick-link-text">

                        <span>Classes</span>

                        <small>
                            Manage school classes
                        </small>

                    </div>

                    <i class="bi bi-arrow-right quick-arrow"></i>

                </a>


                <a href="{{ route('students.index') }}">

                    <div class="quick-link-icon students-link-icon">

                        <i class="bi bi-people-fill"></i>

                    </div>

                    <div class="quick-link-text">

                        <span>Students</span>

                        <small>
                            Manage students
                        </small>

                    </div>

                    <i class="bi bi-arrow-right quick-arrow"></i>

                </a>


                <a href="{{ route('teachers.index') }}">

                    <div class="quick-link-icon teachers-link-icon">

                        <i class="bi bi-person-workspace"></i>

                    </div>

                    <div class="quick-link-text">

                        <span>Teachers</span>

                        <small>
                            Manage teachers
                        </small>

                    </div>

                    <i class="bi bi-arrow-right quick-arrow"></i>

                </a>


                <a href="{{ route('subjects.index') }}">

                    <div class="quick-link-icon subjects-link-icon">

                        <i class="bi bi-book"></i>

                    </div>

                    <div class="quick-link-text">

                        <span>Subjects</span>

                        <small>
                            Manage subjects
                        </small>

                    </div>

                    <i class="bi bi-arrow-right quick-arrow"></i>

                </a>


                <a href="{{ route('assignments.index') }}">

                    <div class="quick-link-icon assignments-link-icon">

                        <i class="bi bi-journal-check"></i>

                    </div>

                    <div class="quick-link-text">

                        <span>Class Subjects</span>

                        <small>
                            Manage class subjects
                        </small>

                    </div>

                    <i class="bi bi-arrow-right quick-arrow"></i>

                </a>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     Subject Distribution
========================== --}}

<div class="subject-distribution mt-5">

    <div class="distribution-card">

        {{-- Header --}}
        <div class="distribution-header">

            <div>

                <span class="distribution-label">
                    ACADEMIC OVERVIEW
                </span>

                <h3>

                    <i class="bi bi-journal-bookmark-fill"></i>

                    Class & Subject Distribution

                </h3>

                <p>
                    Subjects assigned to each class
                </p>

            </div>

            <div class="distribution-header-icon">

                <i class="bi bi-mortarboard-fill"></i>

            </div>

        </div>


        {{-- Classes --}}
        <div class="distribution-body">

            @php

                $groupedAssignments = $assignments->groupBy(
                    function ($assignment) {
                        return $assignment->schoolClass->id;
                    }
                );

            @endphp


            @forelse ($groupedAssignments as $classId => $classAssignments)

                @php

                    $class = $classAssignments
                        ->first()
                        ->schoolClass;

                    preg_match(
                        '/\d+/',
                        $class->name,
                        $matches
                    );

                    $gradeNumber =
                        $matches[0] ?? '';

                @endphp


                <div class="grade-row">

                    {{-- Grade Information --}}
                    <div class="grade-info">

                        <div class="grade-icon">

                            {{
                                str_pad(
                                    $gradeNumber,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                )
                            }}

                        </div>

                        <div>

                            <strong>
                                {{ $class->name }}
                            </strong>

                            <small>
                                Section {{ $class->section }}
                            </small>

                        </div>

                    </div>


                    {{-- Subjects --}}
                    <div class="subjects-container">

                        @foreach ($classAssignments as $assignment)

                            <div class="subject-item">

                                <i class="bi bi-book"></i>

                                <div>

                                    <strong>
                                        {{ $assignment->subject->name }}
                                    </strong>

                                    <small>
                                        {{ $assignment->subject->code }}
                                    </small>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


            @empty

                <div class="text-center text-muted py-5">

                    <i class="bi bi-journal-x fs-2 d-block mb-2"></i>

                    No subjects assigned to any class.

                </div>

            @endforelse

        </div>

    </div>

</div>


</div>

@endsection
