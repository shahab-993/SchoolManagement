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

                        {{-- View --}}
                        <a
                            href="/classes/{{ $class->id }}"
                            class="btn btn-sm btn-info"
                            title="View Class">
                            <i class="bi bi-eye"></i>
                        </a>


                        <a
                            href="{{ route('classes.edit', $class->id) }}"
                            class="btn btn-sm btn-warning"
                            title="Edit Class">
                            <i class="bi bi-pencil"></i>
                        </a>


                        {{-- Delete --}}
                        <form
                            action="{{ route('classes.destroy', $class->id) }}"
                            method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                title="Delete Class">
                                <i class="bi bi-trash"></i>
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