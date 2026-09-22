@extends('layouts.app')

@section('title', 'Student Details')

@section('content')

<div class="container-fluid mt-4 px-4">


{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <h1 class="mb-0">Student Details</h1>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Back
    </a>

</div>

{{-- Student Details Card --}}
<div class="card shadow-sm">

    <div class="card-body p-4">

        <div class="row">

            {{-- Student Information --}}
            <div class="col-lg-8">

                <h4 class="mb-4">
                    {{ $student->first_name }}
                    {{ $student->last_name }}
                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>Class:</strong>
                        {{ $student->schoolClass->name }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Section:</strong>
                        {{ $student->schoolClass->section }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Admission No:</strong>
                        {{ $student->admission_no }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Father Name:</strong>
                        {{ $student->father_name }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Date of Birth:</strong>
                        {{ $student->date_of_birth }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Gender:</strong>
                        {{ $student->gender }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Phone:</strong>
                        {{ $student->phone }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong>
                        {{ $student->email }}
                    </div>

                    <div class="col-12 mb-3">
                        <strong>Address:</strong>
                        {{ $student->address }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Admission Date:</strong>
                        {{ $student->admission_date }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong>

                        @if ($student->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif

                    </div>

                    <div class="col-12">
                        <strong>Notes:</strong>
                        {{ $student->notes }}
                    </div>

                </div>

            </div>


            {{-- Student Photo --}}
            <div class="col-lg-4">

                <div class="text-center">

                    @if ($student->photo)

                        <img
                            src="{{ asset('storage/' . $student->photo) }}"
                            alt="Student Photo"
                            class="img-fluid shadow-sm"
                            style="
                                width: 260px;
                                height: 320px;
                                object-fit: cover;
                                border-radius: 10px;
                            "
                        >

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center mx-auto bg-light text-muted"
                            style="
                                width: 260px;
                                height: 320px;
                                border-radius: 10px;
                            "
                        >
                            <div>
                                <i class="bi bi-person-fill fs-1"></i>
                                <div>No Photo</div>
                            </div>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
