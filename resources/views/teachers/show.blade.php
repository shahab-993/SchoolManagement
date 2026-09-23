@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')

<div class="container-fluid mt-4 px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">Teacher Details</h1>

        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body p-4">

            <div class="row">

                {{-- Teacher Information --}}
                <div class="col-lg-8">

                    <h4 class="mb-4">
                        {{ $teacher->first_name }}
                        {{ $teacher->last_name }}
                    </h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Father Name:</strong>
                            {{ $teacher->father_name }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Education:</strong>
                            {{ $teacher->education }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Education Field:</strong>
                            {{ $teacher->education_field }}
                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Subjects:</strong>

                            @if ($teacher->subjects->count())

                            <ul class="mt-2">

                                @foreach ($teacher->subjects as $subject)

                                <li>
                                    {{ $subject->name }}
                                    ({{ $subject->code }})
                                </li>

                                @endforeach

                            </ul>

                            @else

                            <span class="text-muted">
                                No subjects assigned.
                            </span>

                            @endif

                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Date of Birth:</strong>
                            {{ $teacher->date_of_birth }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Gender:</strong>
                            {{ $teacher->gender }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Phone:</strong>
                            {{ $teacher->phone }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Email:</strong>
                            {{ $teacher->email }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Joining Date:</strong>
                            {{ $teacher->joining_date }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Status:</strong>

                            @if ($teacher->status === 'active')
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif

                        </div>

                        <div class="col-12 mb-3">
                            <strong>Address:</strong>
                            {{ $teacher->address }}
                        </div>

                        <div class="col-12">
                            <strong>Notes:</strong>
                            {{ $teacher->notes }}
                        </div>

                    </div>

                </div>

                {{-- Teacher Photo --}}
                <div class="col-lg-4">

                    <div class="text-center">

                        @if ($teacher->photo)

                        <img
                            src="{{ asset('storage/' . $teacher->photo) }}"
                            alt="Teacher Photo"
                            class="img-fluid shadow-sm"
                            style="
                                    width: 260px;
                                    height: 320px;
                                    object-fit: cover;
                                    border-radius: 10px;
                                ">

                        @else

                        <div
                            class="d-flex align-items-center justify-content-center mx-auto bg-light text-muted"
                            style="
                                    width: 260px;
                                    height: 320px;
                                    border-radius: 10px;
                                ">
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