@extends('layouts.app')

@section('title', 'Class Subject Assignments')

@section('content')

<div class="container-fluid">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Class Subject Assignments</h2>

        <p class="text-muted mb-3">
            Manage subjects assigned to classes.
        </p>

        <div class="col-md-6">

            <div class="input-group">

                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="search"
                    id="assignmentSearch"
                    class="form-control"
                    placeholder="Search assignment by ID, class or subject..."
                    value="{{ $query ?? '' }}"
                >

            </div>

        </div>

    </div>


    <a href="{{ route('assignments.create') }}"
       class="btn btn-primary">

        <i class="bi bi-plus-circle me-1"></i>
        Assign Subjects

    </a>

</div>


{{-- Assignments Card --}}
<div class="card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table
                id="assignmentsTable"
                class="table table-hover mb-0"
            >

                {{-- Table Header --}}
                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Class</th>

                        <th>Subject</th>

                        <th>Actions</th>

                    </tr>

                </thead>


                {{-- Table Body --}}
                <tbody>

                    @forelse ($assignments as $assignment)

                        <tr>

                            {{-- Number --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- Class --}}
                            <td>

                                {{ $assignment->schoolClass->name }}

                                @if ($assignment->schoolClass->section)
                                    - {{ $assignment->schoolClass->section }}
                                @endif

                            </td>


                            {{-- Subject --}}
                            <td>

                                {{ $assignment->subject->name }}

                                @if ($assignment->subject->code)
                                    <span class="text-muted">
                                        - {{ $assignment->subject->code }}
                                    </span>
                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                {{-- Edit --}}
                                <a
                                    href="{{ route(
                                        'assignments.edit',
                                        $assignment
                                    ) }}"
                                    class="btn btn-sm btn-warning"
                                >

                                    <i class="bi bi-pencil me-1"></i>
                                    Edit

                                </a>


                                {{-- Delete --}}
                                <form
                                    action="{{ route(
                                        'assignments.destroy',
                                        $assignment
                                    ) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm(
                                            'Are you sure you want to delete this assignment?'
                                        )"
                                    >

                                        <i class="bi bi-trash me-1"></i>
                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center text-muted py-4"
                            >

                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                No assignments found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="p-3">

            {{ $assignments->links() }}

        </div>

    </div>

</div>
```

</div>

@endsection
