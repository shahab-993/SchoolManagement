@extends('layouts.app')

@section('title', 'Class Subjects')

@section('content')

<div class="container-fluid mt-4 px-4">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="mb-1">Subjects</h1>

        <div class="text-muted">
            {{ $schoolClass->name }}

            @if ($schoolClass->section)
                - {{ $schoolClass->section }}
            @endif
        </div>
    </div>

    <a href="{{ url('/classes') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Back

    </a>

</div>


{{-- Subjects --}}
<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-light">

                    <tr>

                        <th style="width: 70px;">
                            No
                        </th>

                        <th>
                            Subject
                        </th>

                        <th>
                            Code
                        </th>

                        <th style="width: 150px;">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($subjects as $assignment)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $assignment->subject->name }}
                            </td>

                            <td>
                                {{ $assignment->subject->code }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('marks.index', [
                                        'schoolClass' => $schoolClass->id,
                                        'subject' => $assignment->subject->id,
                                    ]) }}"
                                    class="btn btn-sm btn-primary"
                                >

                                    <i class="bi bi-pencil-square me-1"></i>
                                    Marks

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center text-muted py-4"
                            >

                                No subjects assigned to this class.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
```

</div>

@endsection
