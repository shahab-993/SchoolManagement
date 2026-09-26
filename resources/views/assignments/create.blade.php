@extends('layouts.app')

@section('title', 'Assign Subject Teacher')

@section('content')

<div class="container-fluid">

```
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Assign Subject Teacher</h2>
        <p class="text-muted mb-0">
            Assign a teacher to a subject in a class.
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

        <form action="{{ route('assignments.store') }}"
              method="POST">

            @csrf


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

                        <option value="{{ $class->id }}">
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

                        <option value="{{ $subject->id }}">
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

                        <option value="{{ $teacher->id }}">
                            {{ $teacher->first_name }}
                            {{ $teacher->last_name }}
                        </option>

                    @endforeach

                </select>

            </div>


            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-check-circle"></i>
                Assign

            </button>

        </form>

    </div>

</div>
```

</div>

@endsection
