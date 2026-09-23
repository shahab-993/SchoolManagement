
@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Add Subject</h1>

    <form action="{{ route('subjects.store') }}" method="POST">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Name</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="e.g. Mathematics"
                >
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Code</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    placeholder="e.g. MATH101"
                >
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>

                </select>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="3"
                    placeholder="Subject description"
                ></textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary-action">
            <i class="bi bi-save me-1"></i>
            Save Subject
        </button>

        <a
            href="{{ route('subjects.index') }}"
            class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection