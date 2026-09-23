@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Edit Subject</h1>

    <form
        action="{{ route('subjects.update', $subject->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Name</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ $subject->name }}"
                >
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Code</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="{{ $subject->code }}"
                >
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active"
                        {{ $subject->status == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ $subject->status == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="3"
                >{{ $subject->description }}</textarea>

            </div>

        </div>

        <button type="submit" class="btn btn-primary-action">
            <i class="bi bi-save me-1"></i>
            Update Subject
        </button>

        <a
            href="{{ route('subjects.index') }}"
            class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection