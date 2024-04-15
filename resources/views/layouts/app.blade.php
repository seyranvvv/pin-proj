<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description') - Test Project">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PIN</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->

</head>

<body class="min-h-screen relative flex text-neutral-600 bg-slate-200">
    <div class="flex w-screen">

        @include('partials.sidebar')
        <div class="w-full flex flex-col">
            @include('partials.navbar')
            <main class="overflow-hidden">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('js')
</body>

</html>
