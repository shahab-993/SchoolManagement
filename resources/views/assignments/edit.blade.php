@extends('layouts.app')

@section('title', 'Edit Class Subject')

@section('content')

<div class="container-fluid">


{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Edit Class Subject</h2>

        <p class="text-muted mb-0">
            Update the class and subject assignment.
        </p>

    </div>

    <a href="{{ route('assignments.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Back

    </a>

</div>


{{-- Edit Form --}}
<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('assignments.update', $assignment) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Class --}}
            <div class="mb-3">

                <label class="form-label">
                    Class
                </label>

                <select
                    name="class_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        Select Class
                    </option>

                    @foreach ($classes as $class)

                        <option
                            value="{{ $class->id }}"
                            {{ old(
                                'class_id',
                                $assignment->class_id
                            ) == $class->id ? 'selected' : '' }}
                        >

                            {{ $class->name }}

                            @if ($class->section)
                                - {{ $class->section }}
                            @endif

                        </option>

                    @endforeach

                </select>

                @error('class_id')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Subject --}}
            <div class="mb-4">

                <label class="form-label">
                    Subject
                </label>

                <select
                    name="subject_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        Select Subject
                    </option>

                    @foreach ($subjects as $subject)

                        <option
                            value="{{ $subject->id }}"
                            {{ old(
                                'subject_id',
                                $assignment->subject_id
                            ) == $subject->id ? 'selected' : '' }}
                        >

                            {{ $subject->name }}

                            @if ($subject->code)
                                - {{ $subject->code }}
                            @endif

                        </option>

                    @endforeach

                </select>

                @error('subject_id')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Actions --}}
            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="bi bi-save me-1"></i>
                Update Assignment

            </button>


            <a
                href="{{ route('assignments.index') }}"
                class="btn btn-secondary"
            >

                Cancel

            </a>

        </form>

    </div>

</div>


</div>

@endsection
