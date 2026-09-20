@extends('layouts.app')

@section('title', 'Classes')

@section('content')

<div class="container-fluid mt-4 px-4">

    <h1 class="mb-4">Classes</h1>

    @foreach ($classes as $class)

        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">
                    {{ $class->name }}
                </h5>

                <p class="card-text">
                    Section: {{ $class->section }}
                </p>

                <p class="card-text">
                    {{ $class->description }}
                </p>

            </div>
        </div>

    @endforeach

</div>

@endsection