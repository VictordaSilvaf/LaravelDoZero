<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @livewireStyles
</head>

<body class="min-h-screen overflow-y-hidden">
    @yield('body')

    @livewireScripts
    {{-- Flowbit --}}
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <!-- Scripts -->
    <script src="{{ url(mix('js/app.js')) }}"></script>
</body>

</html>
