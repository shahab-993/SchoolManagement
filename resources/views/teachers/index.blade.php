@extends('layouts.app')
@section('title', 'Teacher')
@section('content')

<div class="container-fluid mt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Teachers</h1>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary-action">
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
                    <th>Subjects</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($teachers as $teacher)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $teacher->first_name }}
                        {{ $teacher->last_name }}
                    </td>

                    <td>{{ $teacher->father_name }}</td>

                    <td>{{ $teacher->phone }}</td>
                    <td>
                        @forelse ($teacher->subjects as $subject)
                        <span class="badge bg-secondary">
                            {{ $subject->name }}
                        </span>
                        @empty
                        <span class="text-muted">
                            No subjects
                        </span>
                        @endforelse
                    </td>

                    <td>{{ $teacher->gender }}</td>

                    <td>
                        @if ($teacher->status === 'active')
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>

                        <a
                            href="{{ route('teachers.show',$teacher->id) }}"
                            class="btn btn-sm btn-info"
                            title="View Teacher">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a
                            href="{{ route('teachers.edit', $teacher->id) }}"
                            class="btn btn-sm btn-warning"
                            title="Edit Teacher">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('teachers.destroy',$teacher->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                title="Delete Teacher">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection