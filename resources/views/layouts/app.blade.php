
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

    <nav class="navbar navbar-expand-lg top-bar">

        <div class="container-fluid px-4">


            {{-- School Logo and Brand --}}

            <a class="navbar-brand d-flex align-items-center gap-2"
               href="/">

                <i class="bi bi-mortarboard-fill school-logo"></i>

                <span>
                    School Management
                </span>

            </a>


            {{-- Mobile Sidebar Button --}}

            <button
                class="navbar-toggler"
                type="button"
                id="sidebarToggle">

                <span class="navbar-toggler-icon"></span>

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
                    href="/classes"
                    class="top-menu-link {{ request()->is('classes') ? 'active' : '' }}">

                    Classes

                </a>


                {{-- Students --}}

                <a
                    href="#"
                    class="top-menu-link">

                    Students

                </a>


                {{-- Teachers --}}

                <a
                    href="#"
                    class="top-menu-link">

                    Teachers

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

        <div
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
                            href="/classes"
                            class="nav-link {{ request()->is('classes') ? 'active' : '' }}">

                            <i class="bi bi-building me-2"></i>

                            Classes

                        </a>

                    </li>



                    {{-- Students --}}

                    <li class="nav-item">

                        <a
                            href="#"
                            class="nav-link">

                            <i class="bi bi-people me-2"></i>

                            Students

                        </a>

                    </li>



                    {{-- Teachers --}}

                    <li class="nav-item">

                        <a
                            href="#"
                            class="nav-link">

                            <i class="bi bi-person-workspace me-2"></i>

                            Teachers

                        </a>

                    </li>


                </ul>


            </div>


        </div>



        {{-- =========================
             Page Content
        ========================== --}}

        <main class="main-content">

            @yield('content')

        </main>


    </div>



</body>

</html>

