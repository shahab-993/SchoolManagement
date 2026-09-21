@extends('layouts.app')

@section('title', 'Students')

@section('content')

<div class="container-fluid mt-4 px-4">

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1 class="mb-0">Students</h1>

    <a href="/students/create" class="btn btn-primary-action">
        <i class="bi bi-plus-lg me-1"></i>
        Add Student
    </a>

</div>

    @foreach ($students as $student)

    <div class="card mb-3">

        <div class="card-body">

            <h5 class="card-title">
                {{ $student->first_name }} {{ $student->last_name }}
            </h5>
            <p class="card-text">
                Class: {{ $student->schoolClass->name }}
            </p>

            <p class="card-text">
                Section: {{ $student->schoolClass->section }}
            </p>
            <p class="card-text">
                Admission No: {{ $student->admission_no }}
            </p>

            <p class="card-text">
                Father Name: {{ $student->father_name }}
            </p>

            <p class="card-text">
                Date of Birth: {{ $student->date_of_birth }}
            </p>

            <p class="card-text">
                Gender: {{ $student->gender }}
            </p>

            <p class="card-text">
                Phone: {{ $student->phone }}
            </p>

            <p class="card-text">
                Email: {{ $student->email }}
            </p>

            <p class="card-text">
                Address: {{ $student->address }}
            </p>

            <p class="card-text">
                Admission Date: {{ $student->admission_date }}
            </p>

            <p class="card-text">
                Status: {{ $student->status }}
            </p>

            <p class="card-text">
                Notes: {{ $student->notes }}
            </p>

        </div>

    </div>

    @endforeach

</div>

@endsection