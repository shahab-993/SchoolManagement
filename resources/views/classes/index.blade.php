@extends('layouts.app')

@section('title', 'Classes')

@section('content')

<div class="container-fluid mt-4 px-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <h1 class="mb-0">Classes</h1>
        <div class="col-md-6 mb-4">

            <div class="input-group">

                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="search"
                    id="classSearch"
                    class="form-control"
                    placeholder="Search class by name or ID..."
                    value="{{ $query ?? '' }}">

            </div>

        </div>
        <a href="/classes/create" class="btn btn-primary-action">
            <i class="bi bi-plus-lg me-1"></i>
            Add Class
        </a>

    </div>


    {{-- Classes Table --}}
    <div class="table-responsive">

        <table class="table table-hover align-middle" id="classesTable">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Student Count</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                @foreach ($classes as $class)

                <tr>

                    {{-- Number --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>


                    {{-- Class Name --}}
                    <td>

                        {{ $class->name }}

                    </td>


                    {{-- Section --}}
                    <td>

                        {{ $class->section }}

                    </td>

                    <td>
                        <a href="/classes/{{ $class->id }}/students">
                            {{ $class->students_count }}
                        </a>
                    </td>
                    {{-- Description --}}
                    <td>
                        {{ $class->description }}
                    </td>


                    {{-- Actions --}}
                    <td>

                        <a href="{{ route('classes.edit', $class->id) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <a href="{{ route('classes.subjects', $class->id) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square me-1"></i>
                            Marks
                        </a>

                        <a href="{{ route('results.index', $class->id) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bi bi-bar-chart me-1"></i>
                            Result
                        </a>

                        <form action="{{ route('classes.destroy', $class->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-sm btn-danger">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>
        <div class="mt-4">
            {{ $classes->links() }}
        </div>

    </div>

</div>

@endsection