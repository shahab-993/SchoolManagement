@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')

<div class="container-fluid mt-4 px-4">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="mb-1">
            Edit Class
        </h1>

        <p class="text-muted mb-0">
            Update class information.
        </p>

    </div>

    <a href="{{ route('classes.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Back

    </a>

</div>


{{-- Edit Form --}}
<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('classes.update', $class->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Class Name --}}
            <div class="mb-3">

                <label class="form-label">
                    Class Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $class->name) }}"
                    required
                >

                @error('name')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Section --}}
            <div class="mb-3">

                <label class="form-label">
                    Section
                </label>

                <input
                    type="text"
                    name="section"
                    class="form-control"
                    value="{{ old('section', $class->section) }}"
                    required
                >

                @error('section')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Description --}}
            <div class="mb-4">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                >{{ old('description', $class->description) }}</textarea>

                @error('description')

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
                Update Class

            </button>


            <a
                href="{{ route('classes.index') }}"
                class="btn btn-secondary"
            >

                Cancel

            </a>

        </form>

    </div>

</div>
```

</div>

@endsection
