@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Edit Student</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Admission No</label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $student->admission_no }}"
                    disabled>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">First Name</label>
                <input
                    type="text"
                    name="first_name"
                    class="form-control"
                    value="{{ $student->first_name }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    class="form-control"
                    value="{{ $student->last_name }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Father Name</label>
                <input
                    type="text"
                    name="father_name"
                    class="form-control"
                    value="{{ $student->father_name }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input
                    type="date"
                    name="date_of_birth"
                    class="form-control"
                    value="{{ $student->date_of_birth }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Gender</label>

                <select name="gender" class="form-select">
                    <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>
                        Male
                    </option>

                    <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>
                        Female
                    </option>
                </select>

            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ $student->phone }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ $student->email }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Admission Date</label>
                <input
                    type="date"
                    name="admission_date"
                    class="form-control"
                    value="{{ $student->admission_date }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Class</label>

                <select name="class_id" class="form-select">

                    @foreach ($classes as $class)

                        <option
                            value="{{ $class->id }}"
                            {{ $student->class_id == $class->id ? 'selected' : '' }}>

                            {{ $class->name }} - {{ $class->section }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Photo</label>

                <input
                    type="file"
                    name="photo"
                    class="form-control">

            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Address</label>

                <textarea
                    name="address"
                    class="form-control"
                    rows="3">{{ $student->address }}</textarea>

            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Notes</label>

                <textarea
                    name="notes"
                    class="form-control"
                    rows="3">{{ $student->notes }}</textarea>

            </div>

        </div>

        <button type="submit" class="btn btn-primary-action">
            <i class="bi bi-save me-1"></i>
            Update Student
        </button>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection