@extends('layouts.app')
@section('title','Show Class')
@section('content')
<div class="container-fluid mt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Class Details</h1>
        <a href="/classes" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1">Back</i>
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="mb-4"><strong>Class:</strong> {{ $class->name }}</h4>
            <p><strong>Section: </strong>{{ $class->section }}</p>
            <p>
                <strong>Student Count:</strong>  {{ $class->students->count() }}
              
            </p>
            <p><strong>Decription: </strong>{{ $class->description }}</p>

        </div>
    </div>
</div>

@endsection