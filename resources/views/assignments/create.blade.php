@extends('layouts.app')

@section('title', 'Assign Subject Teacher')

@section('content')

<div class="container-fluid">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Assign Subject Teacher</h2>

        <p class="text-muted mb-0">
            Assign a teacher to multiple subjects in a class.
        </p>
    </div>

    <a href="{{ route('assignments.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Back

    </a>

</div>


{{-- Assignment Form --}}
<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('assignments.store') }}"
              method="POST">

            @csrf


            {{-- Class --}}
            <div class="mb-4">

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
                            {{ old('class_id') == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}
                            - {{ $class->section }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Subject Search --}}
            <div class="mb-2">

                <label class="form-label">
                    Subjects
                </label>

                <div class="input-group mb-3">

                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text"
                           id="subjectSearch"
                           class="form-control"
                           placeholder="Search subject...">

                </div>

            </div>


            {{-- Subjects --}}
            <div class="border rounded p-3 mb-4">

                <div class="row">

                    @foreach ($subjects as $subject)

                        <div class="col-md-6 col-lg-4 mb-2 subject-item">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="subject_id[]"
                                    value="{{ $subject->id }}"
                                    id="subject{{ $subject->id }}"
                                    {{ in_array(
                                        $subject->id,
                                        old('subject_id', [])
                                    ) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="subject{{ $subject->id }}"
                                >

                                    {{ $subject->name }}
                                    <span class="text-muted">
                                        - {{ $subject->grade }}
                                    </span>

                                </label>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>



            {{-- Submit --}}
            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-check-circle me-1"></i>
                Assign Subjects

            </button>

        </form>

    </div>

</div>
```

</div>

@endsection
