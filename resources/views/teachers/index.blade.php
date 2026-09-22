@extends('layouts.app')
@section('title', 'Teacher')
@section('content')

<div class="container-fluid mt-4 px-4">
    <div class="d-flex justify-content-between align-content-center mb-4">
        <h1 class="mb-0">Teachers</h1>
        <a href="#" class="btn btn-primary-action">
            <i class="bi bi-plus-lg me-1"></i>
             Add Teacher
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
    
@endsection