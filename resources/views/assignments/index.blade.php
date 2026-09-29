@extends('layouts.app')

@section('title', 'Class Subjects')

@section('content')

<div class="container-fluid">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Class Subjects</h2>

        <p class="text-muted mb-0">
            Select a class to view and manage its subjects.
        </p>

    </div>

    <a
        href="{{ route('assignments.create') }}"
        class="btn btn-primary"
    >

        <i class="bi bi-plus-circle me-1"></i>
        Assign Subjects

    </a>

</div>


{{-- Classes --}}
<div class="row g-4">

    @forelse ($classes as $class)

        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

            <a
                href="{{ route(
                    'classes.subjects',
                    $class->id
                ) }}"
                class="text-decoration-none"
            >

                <div class="card shadow-sm h-100 border-0">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center mb-3">

                            <div
                                class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px;"
                            >

                                <i class="bi bi-building fs-4 text-primary"></i>

                            </div>

                            <div>

                                <h5 class="mb-1 text-dark">
                                    {{ $class->name }}
                                </h5>

                                @if ($class->section)

                                    <span class="text-muted">
                                        Section {{ $class->section }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="text-muted">

                            <i class="bi bi-book me-1"></i>

                            View Subjects

                            <i class="bi bi-arrow-right float-end"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

    @empty

        <div class="col-12">

            <div class="text-center text-muted py-5">

                <i class="bi bi-building-x fs-1 d-block mb-3"></i>

                No classes found.

            </div>

        </div>

    @endforelse

</div>


{{-- Pagination --}}
@if ($classes->hasPages())

    <div class="mt-4">

        {{ $classes->links() }}

    </div>

@endif
```

</div>

@endsection
