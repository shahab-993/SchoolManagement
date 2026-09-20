```blade
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid mt-4 px-4">

    {{-- Dashboard Header --}}

    <div class="mb-4">

        <h1 class="fw-bold">
            Dashboard
        </h1>

        <p class="text-muted mb-0">
            Welcome to School Management System
        </p>

    </div>


    {{-- Statistics Cards --}}

    <div class="row g-4">


        {{-- Students --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card dashboard-card students-card h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="dashboard-label mb-2">
                                Total Students
                            </p>

                            <h2 class="dashboard-number mb-0">
                                120
                            </h2>

                        </div>


                        <div class="dashboard-icon students-icon">

                            <i class="bi bi-people-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Teachers --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card dashboard-card teachers-card h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="dashboard-label mb-2">
                                Total Teachers
                            </p>

                            <h2 class="dashboard-number mb-0">
                                15
                            </h2>

                        </div>


                        <div class="dashboard-icon teachers-icon">

                            <i class="bi bi-person-workspace"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Classes --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card dashboard-card classes-card h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="dashboard-label mb-2">
                                Total Classes
                            </p>

                            <h2 class="dashboard-number mb-0">
                                10
                            </h2>

                        </div>


                        <div class="dashboard-icon classes-icon">

                            <i class="bi bi-building"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Subjects --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card dashboard-card subjects-card h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="dashboard-label mb-2">
                                Total Subjects
                            </p>

                            <h2 class="dashboard-number mb-0">
                                25
                            </h2>

                        </div>


                        <div class="dashboard-icon subjects-icon">

                            <i class="bi bi-book-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>

@endsection
```
