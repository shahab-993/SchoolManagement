@extends('layouts.app')

@section('title', 'Students')

@section('content')

<div class="container-fluid mt-4 px-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">Students</h1>

        <a href="/students/create" class="btn btn-primary-action">
            <i class="bi bi-plus-lg me-1"></i>
            Add Student
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
                    <th>Class</th>
                    <th>Section</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                @foreach ($students as $student)

                <tr>

                    {{-- Number --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>


                    {{-- Admission Number --}}
                    <td>
                        {{ $student->admission_no }}
                    </td>


                    {{-- Student Name --}}
                    <td>
                        {{ $student->first_name }}
                        {{ $student->last_name }}
                    </td>


                    {{-- Father Name --}}
                    <td>
                        {{ $student->father_name }}
                    </td>


                    {{-- Class --}}
                    <td>
                        {{ $student->schoolClass->name }}
                    </td>


                    {{-- Section --}}
                    <td>
                        {{ $student->schoolClass->section }}
                    </td>


                    {{-- Phone --}}
                    <td>
                        {{ $student->phone }}
                    </td>


                    {{-- Status --}}
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

                    {{-- Actions --}}
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
                            href="#"
                            class="btn btn-sm btn-warning"
                            title="Edit Student">
                            <i class="bi bi-pencil"></i>
                        </a>


                        {{-- Delete --}}
                        <button
                            type="button"
                            class="btn btn-sm btn-danger"
                            title="Delete Student">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection