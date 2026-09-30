@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<div class="login-page">

    <div class="login-card">

        {{-- =========================
             Left Branding Section
        ========================== --}}

        <div class="login-brand">

            <div class="brand-logo">

                <i class="bi bi-mortarboard-fill"></i>

            </div>

            <h1>
                School Management
            </h1>

            <p>
                Smart, simple and secure school management system.
            </p>

            <div class="brand-line"></div>

            <small>
                Manage your school with confidence.
            </small>

        </div>


        {{-- =========================
             Right Login Section
        ========================== --}}

        <div class="login-form-section">

            <div class="login-form-wrapper">

                {{-- Header --}}

                <div class="login-heading">

                    <span class="welcome-text">
                        Welcome Back
                    </span>

                    <h2>
                        Sign in to your account
                    </h2>

                    <p>
                        Enter your credentials to access your dashboard.
                    </p>

                </div>


                {{-- Login Form --}}

                <form
                    method="POST"
                    action="{{ route('login') }}">

                    @csrf


                    {{-- Email --}}

                    <div class="login-input-group mb-4">

                        <label
                            for="email"
                            class="form-label">

                            Email Address

                        </label>

                        <div class="input-with-icon">

                            <i class="bi bi-envelope"></i>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                placeholder="Enter your email"
                                required
                                autofocus
                                autocomplete="username">

                        </div>

                        @error('email')

                            <div class="login-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- Password --}}

                    <div class="login-input-group mb-3">

                        <label
                            for="password"
                            class="form-label">

                            Password

                        </label>

                        <div class="input-with-icon">

                            <i class="bi bi-lock"></i>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password">

                            <button
                                type="button"
                                class="password-toggle"
                                id="passwordToggle"
                                aria-label="Show password">

                                <i
                                    class="bi bi-eye"
                                    id="passwordIcon">
                                </i>

                            </button>

                        </div>

                        @error('password')

                            <div class="login-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- Remember Me --}}

                    <div class="login-options mb-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember">

                            <label
                                class="form-check-label"
                                for="remember">

                                Remember me

                            </label>

                        </div>

                    </div>


                    {{-- Login Button --}}

                    <button
                        type="submit"
                        class="login-button">

                        <span>
                            Login to Dashboard
                        </span>

                        <i class="bi bi-arrow-right"></i>

                    </button>

                </form>


                {{-- Footer --}}

                <div class="login-footer">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Secure access to your school system
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     Password Show / Hide
========================= --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const passwordInput =
            document.getElementById('password');

        const passwordToggle =
            document.getElementById('passwordToggle');

        const passwordIcon =
            document.getElementById('passwordIcon');

        if (
            passwordInput &&
            passwordToggle &&
            passwordIcon
        ) {

            passwordToggle.addEventListener(
                'click',
                function () {

                    if (
                        passwordInput.type === 'password'
                    ) {

                        passwordInput.type = 'text';

                        passwordIcon.classList.remove(
                            'bi-eye'
                        );

                        passwordIcon.classList.add(
                            'bi-eye-slash'
                        );

                        passwordToggle.setAttribute(
                            'aria-label',
                            'Hide password'
                        );

                    } else {

                        passwordInput.type = 'password';

                        passwordIcon.classList.remove(
                            'bi-eye-slash'
                        );

                        passwordIcon.classList.add(
                            'bi-eye'
                        );

                        passwordToggle.setAttribute(
                            'aria-label',
                            'Show password'
                        );

                    }

                }
            );

        }

    });

</script>

@endsection