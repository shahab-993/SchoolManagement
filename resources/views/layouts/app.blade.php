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

                    <li class="nav-item">

                        <a
                            href="{{ route('classes.index') }}"
                            class="nav-link {{ request()->is('classes*') ? 'active' : '' }}">

                            <i class="bi bi-building me-2"></i>

                            Classes

                        </a>

                    </li>



                    {{-- Students --}}

                    <li class="nav-item">

                        <a
                            href="{{ route('students.index') }}"
                            class="nav-link {{ request()->is('students*') ? 'active' : '' }}">

                            <i class="bi bi-people me-2"></i>

                            Students

                        </a>

                    </li>



                    {{-- Teachers --}}

                    <li class="nav-item">

                        <a
                            href="{{ route('teachers.index') }}"
                            class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}">

                            <i class="bi bi-person-workspace me-2"></i>

                            Teachers

                        </a>

                    </li>



                    {{-- Subjects --}}

                    <li class="nav-item">

                        <a
                            href="{{ route('subjects.index') }}"
                            class="nav-link {{ request()->is('subjects*') ? 'active' : '' }}">

                            <i class="bi bi-book me-2"></i>

                            Subjects

                        </a>

                    </li>


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



</body>

</html>