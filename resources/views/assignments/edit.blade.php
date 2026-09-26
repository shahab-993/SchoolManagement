@extends('layouts.app')

@section('title', 'Edit Assignment')

@section('content')

<div class="container-fluid">

```
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Edit Assignment</h2>

        <p class="text-muted mb-0">
            Update the class, subject, or teacher assignment.
        </p>
    </div>

    <a href="{{ route('assignments.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>
        Back

    </a>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('assignments.update', $assignment) }}"
              method="POST">

            @csrf
            @method('PUT')


            {{-- Class --}}

            <div class="mb-3">

                <label class="form-label">
                    Class
                </label>

                <select name="class_id"
                        class="form-select"
                        required>

                    <option value="">
                        Select Class
                    </option>

                    @foreach ($classes as $class)

                        <option value="{{ $class->id }}"
                            {{ $assignment->class_id == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}
                            - {{ $class->section }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Subject --}}

            <div class="mb-3">

                <label class="form-label">
                    Subject
                </label>

                <select name="subject_id"
                        class="form-select"
                        required>

                    <option value="">
                        Select Subject
                    </option>

                    @foreach ($subjects as $subject)

                        <option value="{{ $subject->id }}"
                            {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>

                            {{ $subject->name }}
                            - {{ $subject->grade }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Teacher --}}

            <div class="mb-3">

                <label class="form-label">
                    Teacher
                </label>

                <select name="teacher_id"
                        class="form-select"
                        required>

                    <option value="">
                        Select Teacher
                    </option>

                    @foreach ($teachers as $teacher)

                        <option value="{{ $teacher->id }}"
                            {{ $assignment->teacher_id == $teacher->id ? 'selected' : '' }}>

                            {{ $teacher->first_name }}
                            {{ $teacher->last_name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-check-circle"></i>
                Update Assignment

            </button>

        </form>

    </div>

</div>
```

</div>

@endsection
