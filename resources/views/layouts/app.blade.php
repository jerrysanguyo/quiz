<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Conditional rendering of navigation bar based on user type -->
        @if(auth()->check())
            @if(auth()->user()->type === 'admin')
                @include('layouts.admin_nav')
            @elseif(auth()->user()->type === 'user')
                @include('layouts.user_nav')
            @else
                @include('layouts.judge_nav');
            @endif
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
