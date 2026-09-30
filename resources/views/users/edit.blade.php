@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid mt-4 px-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="mb-1">Edit User</h1>
            <p class="text-muted mb-0">
                Update user information
            </p>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Users
        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Edit User Form --}}
    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <form
                action="{{ route('users.update', $user->id) }}"
                method="POST">

                @csrf
                @method('PUT')


                {{-- Name --}}
                <div class="mb-3">

                    <label for="name" class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Role --}}
                <div class="mb-3">

                    <label for="role_id" class="form-label">
                        Role
                    </label>

                    <select
                        name="role_id"
                        id="role_id"
                        class="form-select @error('role_id') is-invalid @enderror"
                        required>

                        <option value="">
                            Select Role
                        </option>

                        @foreach ($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>

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
                <div class="mb-3">

                    <label for="password" class="form-label">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Leave blank to keep current password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text">
                        Leave this field empty if you do not want to change the password.
                    </div>

                </div>


                {{-- Confirm Password --}}
                <div class="mb-4">

                    <label for="password_confirmation" class="form-label">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control">

                </div>


                {{-- Buttons --}}
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-check-lg me-1"></i>
                        Update User

                    </button>

                    <a
                        href="{{ route('users.index') }}"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection