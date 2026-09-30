
@extends('layouts.app')

@section('title', 'Add User')

@section('content')

<div class="container-fluid mt-4 px-4">


    {{-- =========================
         Page Header
    ========================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-1">
                Add User
            </h1>

            <p class="text-muted mb-0">
                Create a new system user.
            </p>

        </div>


        {{-- Back Button --}}

        <a
            href="{{ route('users.index') }}"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Back to Users

        </a>

    </div>



    {{-- =========================
         Validation Errors
    ========================== --}}

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- =========================
         Create User Form
    ========================== --}}

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">

                <i class="bi bi-person-plus me-2"></i>

                User Information

            </h5>

        </div>


        <div class="card-body p-4">


            <form
                method="POST"
                action="{{ route('users.store') }}">

                @csrf


                <div class="row g-4">


                    {{-- Name --}}

                    <div class="col-12 col-md-6">

                        <label
                            for="name"
                            class="form-label">

                            Name

                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Enter user name"
                            required
                            autofocus>

                        @error('name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- Email --}}

                    <div class="col-12 col-md-6">

                        <label
                            for="email"
                            class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Enter email address"
                            required>

                        @error('email')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- Role --}}

                    <div class="col-12 col-md-6">

                        <label
                            for="role_id"
                            class="form-label">

                            Role

                        </label>

                        <select
                            id="role_id"
                            name="role_id"
                            class="form-select @error('role_id') is-invalid @enderror"
                            required>

                            <option value="">
                                Select Role
                            </option>


                            @foreach ($roles as $role)

                                <option
                                    value="{{ $role->id }}"
                                    {{ old('role_id') == $role->id ? 'selected' : '' }}>

                                    {{ $role->display_name }}

                                </option>

                            @endforeach

                        </select>


                        @error('role_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- Password --}}

                    <div class="col-12 col-md-6">

                        <label
                            for="password"
                            class="form-label">

                            Password

                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter password"
                            required>

                        @error('password')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- Confirm Password --}}

                    <div class="col-12 col-md-6">

                        <label
                            for="password_confirmation"
                            class="form-label">

                            Confirm Password

                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm password"
                            required>

                    </div>


                </div>



                {{-- =========================
                     Form Buttons
                ========================== --}}

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">


                    <a
                        href="{{ route('users.index') }}"
                        class="btn btn-secondary">

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary-action">

                        <i class="bi bi-check-lg me-1"></i>

                        Create User

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection

