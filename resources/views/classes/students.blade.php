@extends('layouts.app')

@section('title', 'Class Students')

@section('content')

<div class="container-fluid mt-4 px-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="mb-1">
                {{ $class->name }} - {{ $class->section }}
            </h1>

            <p class="text-muted mb-0">
                Students in this class
            </p>
        </div>

        <a href="/classes" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

    </div>


    {{-- Students Table --}}
    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Admission No</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($students as $student)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $student->admission_no }}
                    </td>

                    <td>
                        {{ $student->first_name }}
                        {{ $student->last_name }}
                    </td>

                    <td>
                        {{ $student->father_name }}
                    </td>

                    <td>
                        {{ $student->phone }}
                    </td>

                    <td>

                        @if ($student->status === 'active')

                        <span class="badge bg-success">
                            Active
                        </span>

                        @else

                        <span class="badge bg-danger">
                            Inactive
                        </span>

                        @endif

                    </td>

                    <td>

                        {{-- View --}}
                        <a
                            href="/students/{{ $student->id }}"
                            class="btn btn-sm btn-info"
                            title="View Student">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a
                            href="/students/{{ $student->id }}/edit"
                            class="btn btn-sm btn-warning"
                            title="Edit Student">
                            <i class="bi bi-pencil"></i>
                        </a>

                        {{-- Delete --}}
                        <form
                            action="/students/{{ $student->id }}"
                            method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                title="Delete Student">
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