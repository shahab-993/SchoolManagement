@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Edit Class</h1>

    <form action="/classes/{{ $class->id }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Class Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ $class->name }}"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Section</label>

            <input
                type="text"
                name="section"
                class="form-control"
                value="{{ $class->section }}"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>

            <textarea
                name="description"
                class="form-control"
                rows="3"
            >{{ $class->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary-action">
            <i class="bi bi-save me-1"></i>
            Update Class
        </button>

        <a href="/classes" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection