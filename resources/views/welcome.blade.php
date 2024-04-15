<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PIN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen flex justify-center content-center items-center">
    <div class="flex flex-col items-center"><img src="{{ asset('assets/img/main-logo.png') }}" alt="main logo">
        <a class="text-lg text-blue-700 underline" href="{{ route('product.index') }}">Продукты</a>
        <a class="text-lg text-blue-700 underline" href="{{ route('login.form') }}">Логин</a>
    </div>
</body>

</html>
