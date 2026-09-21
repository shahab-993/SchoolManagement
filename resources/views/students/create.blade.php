@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Add Student</h1>

    <form action="/students" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            {{-- Admission No --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Admission No</label>
                <input
                    type="text"
                    name="admission_no"
                    class="form-control"
                >
            </div>

            {{-- First Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name</label>
                <input
                    type="text"
                    name="first_name"
                    class="form-control"
                >
            </div>

            {{-- Last Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    class="form-control"
                >
            </div>

            {{-- Father Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Father Name</label>
                <input
                    type="text"
                    name="father_name"
                    class="form-control"
                >
            </div>

            {{-- Date of Birth --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input
                    type="date"
                    name="date_of_birth"
                    class="form-control"
                >
            </div>

            {{-- Gender --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            {{-- Phone --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                >
            </div>

            {{-- Email --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                >
            </div>

            {{-- Address --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea
                    name="address"
                    class="form-control"
                    rows="3"
                ></textarea>
            </div>

            {{-- Admission Date --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Admission Date</label>
                <input
                    type="date"
                    name="admission_date"
                    class="form-control"
                >
            </div>

            {{-- Class --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Class</label>
                <select name="class_id" class="form-select">
                    <option value="">Select Class</option>

                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">
                            {{ $class->name }} - {{ $class->section }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Photo --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Photo</label>
                <input
                    type="file"
                    name="photo"
                    class="form-control"
                >
            </div>

            {{-- Status --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            {{-- Notes --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Notes</label>
                <textarea
                    name="notes"
                    class="form-control"
                    rows="3"
                ></textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Save Student
        </button>

        <a href="/students" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection