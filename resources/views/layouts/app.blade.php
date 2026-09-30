
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>
        @yield('title', 'School Management System')
    </title>

</head>

<body>

{{-- =========================
     Top Bar
========================== --}}

<nav class="navbar top-bar">

    <div class="container-fluid px-4">

        {{-- School Logo and Brand --}}
        <a
            class="navbar-brand d-flex align-items-center gap-2"
            href="/">

            <i class="bi bi-mortarboard-fill school-logo"></i>

            <span>
                School Management
            </span>

        </a>


        {{-- Mobile Sidebar Button --}}
        <button
            type="button"
            id="sidebarToggle"
            class="btn sidebar-toggle">

            <i class="bi bi-list"></i>

        </button>


        {{-- Top Menu --}}
        <div class="top-menu">

            {{-- Dashboard --}}
            <a
                href="/"
                class="top-menu-link {{ request()->is('/') ? 'active' : '' }}">

                Dashboard

            </a>


            {{-- Classes --}}
            <a
                href="{{ route('classes.index') }}"
                class="top-menu-link {{ request()->is('classes*') ? 'active' : '' }}">

                Classes

            </a>


            {{-- Students --}}
            <a
                href="{{ route('students.index') }}"
                class="top-menu-link {{ request()->is('students*') ? 'active' : '' }}">

                Students

            </a>


            {{-- Teachers --}}
            <a
                href="{{ route('teachers.index') }}"
                class="top-menu-link {{ request()->is('teachers*') ? 'active' : '' }}">

                Teachers

            </a>


            {{-- Subjects --}}
            <a
                href="{{ route('subjects.index') }}"
                class="top-menu-link {{ request()->is('subjects*') ? 'active' : '' }}">

                Subjects

            </a>


            {{-- =========================
                 User Menu
            ========================== --}}

            <div class="user-menu">

                {{-- User Button --}}
                <button
                    type="button"
                    id="userMenuButton"
                    class="user-button">

                    {{-- User Icon --}}
                    <span class="user-icon">

                        <i class="bi bi-person-fill"></i>

                    </span>


                    {{-- User Information --}}
                    <span class="user-info">

                        <span class="user-name">

                            {{ Auth::user()->name }}

                        </span>

                        <span class="user-role">

                            {{ Auth::user()->role->display_name ?? 'User' }}

                        </span>

                    </span>


                    {{-- Arrow --}}
                    <i class="bi bi-chevron-down user-arrow"></i>

                </button>


                {{-- =========================
                     User Dropdown
                ========================== --}}

                <div
                    id="userDropdown"
                    class="user-dropdown">


                    {{-- User Header --}}
                    <div class="user-dropdown-header">

                        <div class="user-dropdown-icon">

                            <i class="bi bi-person-fill"></i>

                        </div>


                        <div class="user-dropdown-info">

                            <strong>

                                {{ Auth::user()->name }}

                            </strong>

                            <span>

                                {{ Auth::user()->email }}

                            </span>

                            <small>

                                {{ Auth::user()->role->display_name ?? 'User' }}

                            </small>

                        </div>

                    </div>


                    {{-- Divider --}}
                    <div class="user-divider"></div>


                    {{-- =========================
                         Users
                    ========================== --}}

                    @if(auth()->user()->hasPermission('view_users'))

                        <a
                            href="{{ route('users.index') }}"
                            class="user-dropdown-item">

                            <i class="bi bi-people"></i>

                            <span>
                                Users
                            </span>

                        </a>

                    @endif


                    {{-- Add User --}}

                    @if(auth()->user()->hasPermission('create_users'))

                        <a
                            href="{{ route('users.create') }}"
                            class="user-dropdown-item">

                            <i class="bi bi-person-plus"></i>

                            <span>
                                Add User
                            </span>

                        </a>

                    @endif


                    {{-- Profile --}}

                    <a
                        href="{{ route('profile.edit') }}"
                        class="user-dropdown-item">

                        <i class="bi bi-person-circle"></i>

                        <span>
                            Profile
                        </span>

                    </a>


                    {{-- Divider --}}
                    <div class="user-divider"></div>


                    {{-- Logout --}}

                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="user-dropdown-item logout-item">

                            <i class="bi bi-box-arrow-right"></i>

                            <span>
                                Logout
                            </span>

                        </button>

                    </form>


                </div>

            </div>


        </div>

    </div>

</nav>


{{-- =========================
     Main Layout
========================== --}}

<div class="main-layout">


    {{-- =========================
         Sidebar
    ========================== --}}

    <aside
        id="sidebar"
        class="sidebar">

        <div class="p-3">

            <ul class="nav flex-column">


                {{-- Dashboard --}}

                <li class="nav-item">

                    <a
                        href="/"
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}">

                        <i class="bi bi-speedometer2 me-2"></i>

                        Dashboard

                    </a>

                </li>


                {{-- Classes --}}

                @if(auth()->user()->hasPermission('view_classes'))

                    <li class="nav-item">

                        <a
                            href="{{ route('classes.index') }}"
                            class="nav-link {{ request()->is('classes*') ? 'active' : '' }}">

                            <i class="bi bi-building me-2"></i>

                            Classes

                        </a>

                    </li>

                @endif


                {{-- Students --}}

                @if(auth()->user()->hasPermission('view_students'))

                    <li class="nav-item">

                        <a
                            href="{{ route('students.index') }}"
                            class="nav-link {{ request()->is('students*') ? 'active' : '' }}">

                            <i class="bi bi-people me-2"></i>

                            Students

                        </a>

                    </li>

                @endif


                {{-- Teachers --}}

                @if(auth()->user()->hasPermission('view_teachers'))

                    <li class="nav-item">

                        <a
                            href="{{ route('teachers.index') }}"
                            class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}">

                            <i class="bi bi-person-workspace me-2"></i>

                            Teachers

                        </a>

                    </li>

                @endif


                {{-- Subjects --}}

                @if(auth()->user()->hasPermission('view_subjects'))

                    <li class="nav-item">

                        <a
                            href="{{ route('subjects.index') }}"
                            class="nav-link {{ request()->is('subjects*') ? 'active' : '' }}">

                            <i class="bi bi-book me-2"></i>

                            Subjects

                        </a>

                    </li>

                @endif


                {{-- Users --}}

                @if(auth()->user()->hasPermission('view_users'))

                    <li class="nav-item">

                        <a
                            href="{{ route('users.index') }}"
                            class="nav-link {{ request()->is('users*') ? 'active' : '' }}">

                            <i class="bi bi-person-gear me-2"></i>

                            Users

                        </a>

                    </li>

                @endif


            </ul>

        </div>

    </aside>


    {{-- =========================
         Page Content
    ========================== --}}

    <main class="main-content">


        {{-- Success Message --}}

        @if (session('success'))

            <div
                id="success-message"
                class="alert alert-success text-center success-message">

                {{ session('success') }}

            </div>


            <script>

                setTimeout(function () {

                    const message =
                        document.getElementById('success-message');

                    if (message) {

                        message.remove();

                    }

                }, 3000);

            </script>

        @endif


        {{-- Page Content --}}

        @yield('content')


    </main>


</div>


{{-- =========================
     User Dropdown JavaScript
========================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const userMenuButton =
            document.getElementById('userMenuButton');

        const userDropdown =
            document.getElementById('userDropdown');

        const userArrow =
            document.querySelector('.user-arrow');


        if (
            userMenuButton &&
            userDropdown
        ) {

            userMenuButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    userDropdown.classList.toggle('show');


                    if (userArrow) {

                        userArrow.classList.toggle('rotate');

                    }

                }
            );


            userDropdown.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                }
            );


            document.addEventListener(
                'click',
                function () {

                    userDropdown.classList.remove('show');


                    if (userArrow) {

                        userArrow.classList.remove('rotate');

                    }

                }
            );

        }

    });

</script>


</body>

</html>

