@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

<div class="container-fluid mt-4 px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">Subjects</h1>
        <div class="col-md-6 mb-4">

            <div class="input-group">

                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="search"
                    id="subjectListSearch"
                    class="form-control"
                    placeholder="Search subject by ID, name or code..."
                    value="{{ $query ?? '' }}">
            </div>

        </div>

        <a href="{{ route('subjects.create') }}" class="btn btn-primary-action">
            <i class="bi bi-plus-lg me-1"></i>
            Add Subject
        </a>

    </div>

    <div class="table-responsive">

        <table id="subjectsTable" class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($subjects as $subject)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $subject->name }}</td>

                    <td>{{ $subject->code }}</td>

                    <td>{{ $subject->description }}</td>

                    <td>
                        @if ($subject->status === 'active')
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>

                        <a
                            href="{{ route('subjects.show', $subject->id) }}"
                            class="btn btn-sm btn-info"
                            title="View Subject">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a
                            href="{{ route('subjects.edit', $subject->id) }}"
                            class="btn btn-sm btn-warning"
                            title="Edit Subject">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form
                            action="{{ route('subjects.destroy', $subject->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                title="Delete Subject">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>
        <div class="mt-4">
            {{ $subjects->links() }}
        </div>

    </div>

</div>

@endsection