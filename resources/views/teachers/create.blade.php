@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Add Teacher</h1>

    <form
        action="{{ route('teachers.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="row">

            {{-- First Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name</label>
                <input
                    type="text"
                    name="first_name"
                    class="form-control">
            </div>

            {{-- Last Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    class="form-control">
            </div>

            {{-- Father Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Father Name</label>
                <input
                    type="text"
                    name="father_name"
                    class="form-control">
            </div>

            {{-- Education --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Education</label>
                <input
                    type="text"
                    name="education"
                    class="form-control"
                    placeholder="Bachelor / Master / PhD">
            </div>

            {{-- Education Field --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Education Field</label>
                <input
                    type="text"
                    name="education_field"
                    class="form-control"
                    placeholder="Computer Science">
            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">Subjects</label>

                <div class="subject-selector">

                    {{-- Search --}}
                    <input
                        type="text"
                        id="subjectSearch"
                        class="form-control mb-2"
                        placeholder="Search subjects...">

                    {{-- Subjects --}}
                    <div
                        id="subjectList"
                        class="border rounded p-4"
                        style="max-height: 250px; overflow-y: auto;">

                        @foreach ($subjects as $subject)

                        <div class="form-check subject-item">

                            <input
                                type="checkbox"
                                name="subjects[]"
                                value="{{ $subject->id }}"
                                class="form-check-input subject-checkbox"
                                id="subject{{ $subject->id }}">

                            <label
                                class="form-check-label"
                                for="subject{{ $subject->id }}">

                                {{ $subject->name }} - {{ $subject->code }}

                            </label>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

            {{-- Date of Birth --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input
                    type="date"
                    name="date_of_birth"
                    class="form-control">
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
                    class="form-control">
            </div>

            {{-- Email --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control">
            </div>

            {{-- Joining Date --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Joining Date</label>
                <input
                    type="date"
                    name="joining_date"
                    class="form-control">
            </div>

            {{-- Status --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            {{-- Photo --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Photo</label>

                <input
                    type="file"
                    name="photo"
                    class="form-control">
            </div>

            {{-- Address --}}
            <div class="col-12 mb-3">
                <label class="form-label">Address</label>

                <textarea
                    name="address"
                    class="form-control"
                    rows="3"></textarea>
            </div>

            {{-- Notes --}}
            <div class="col-12 mb-3">
                <label class="form-label">Notes</label>

                <textarea
                    name="notes"
                    class="form-control"
                    rows="3"></textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary-action">
            <i class="bi bi-save me-1"></i>
            Save Teacher
        </button>

        <a
            href="{{ route('teachers.index') }}"
            class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection