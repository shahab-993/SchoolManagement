@extends('layouts.app')

@section('title', 'Result Report')

@section('content')

<div class="container-fluid mt-4 px-4">


{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="mb-1">Result Report</h1>

        <div class="text-muted">
            {{ $schoolClass->name }}

            @if ($schoolClass->section)
                - {{ $schoolClass->section }}
            @endif
        </div>
    </div>

    <a href="{{ route('classes.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Back

    </a>

</div>


{{-- Result Table --}}
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
                            Student
                        </th>

                        @foreach ($subjects as $subject)

                            <th>
                                {{ $subject->name }}
                                <small class="text-muted d-block">
                                    / 100
                                </small>
                            </th>

                        @endforeach

                        <th>
                            Total
                        </th>

                        <th>
                            Percentage
                        </th>

                        <th>
                            Grade
                        </th>

                        <th>
                            Result
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($results as $result)

                        <tr>

                            {{-- No --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- Student --}}
                            <td>
                                {{ $result['student']->first_name }}
                                {{ $result['student']->last_name }}
                            </td>


                            {{-- Subjects --}}
                            @foreach ($result['subjects'] as $studentSubject)

                                <td>
                                    {{ $studentSubject['total'] }}
                                </td>

                            @endforeach


                            {{-- Total --}}
                            <td>
                                <strong>
                                    {{ $result['total_marks'] }}
                                </strong>
                                /
                                {{ $result['maximum_marks'] }}
                            </td>


                            {{-- Percentage --}}
                            <td>
                                {{ $result['percentage'] }}%
                            </td>


                            {{-- Grade --}}
                            <td>
                                <strong>
                                    {{ $result['grade'] }}
                                </strong>
                            </td>


                            {{-- Result --}}
                            <td>

                                @if ($result['result'] === 'Pass')

                                    <span class="badge bg-success">
                                        Pass
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Fail
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="{{ 7 + $subjects->count() }}"
                                class="text-center text-muted py-4"
                            >
                                No students found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($students->hasPages())

            <div class="mt-3">
                {{ $students->links() }}
            </div>

        @endif

    </div>

</div>


</div>

@endsection
