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

<body class="auth-page">

    @yield('content')

</body>

</html>