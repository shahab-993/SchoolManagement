@extends('layouts.app')

@section('title', 'Subject Details')

@section('content')

<div class="container-fluid mt-4 px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">Subject Details</h1>

        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body p-4">

            <h4 class="mb-4">
                {{ $subject->name }}
            </h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Subject Name:</strong>
                    {{ $subject->name }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Subject Code:</strong>
                    {{ $subject->code }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Status:</strong>

                    @if ($subject->status === 'active')
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif

                </div>

                <div class="col-12">
                    <strong>Description:</strong>
                    {{ $subject->description }}
                </div>
                <div class="mt-4">

                    <strong>Classes:</strong>

                    @if ($subject->classes->count())

                    <ul class="mt-2">

                        @foreach ($subject->classes as $class)

                        <li>
                            {{ $class->name }}
                            (Section {{ $class->section }})
                        </li>

                        @endforeach

                    </ul>

                    @else

                    <p class="text-muted mt-2">
                        No classes assigned.
                    </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection