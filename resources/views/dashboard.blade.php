
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
                            120
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
                            15
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
                            10
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
                            25
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
         Welcome Section
    ========================== --}}

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


                <a href="/classes">

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



                <a href="#">

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


            </div>

        </div>

    </div>


</div>


</div>

@endsection

