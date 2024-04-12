<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description') - Test Project">

    <title>Test Project</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->

</head>

<body class="min-h-screen  relative flex  text-neutral-600 bg-neutral-600">
    @include('partials.sidebar')
    <main class="overflow-hidden">
        @yield('content')
    </main>
    @stack('js')
</body>

</html>
