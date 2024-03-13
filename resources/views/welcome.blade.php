<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kode+Mono&display=swap" rel="stylesheet">
        <!-- Styles -->
        <style>
            body {
                background-image: url('{{ asset('imgs/welcome-bg.webp') }}');
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed; 
                background-position: center; 
            }
            img {
                width: 10px;
            }
            .glowing-text {
            color: pink;
            animation: glowing 1s infinite alternate;
        }

        @keyframes glowing {
            from {
                text-shadow: 0 0 1px white;
            }
            to {
                text-shadow: 0 0 20px pink;
            }
        }
        </style>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand"></a> <!-- for title -->
                <div class="d-flex" role="search">
                    <div class="ml-3">
                    @if (Route::has('login'))
                        @auth
                            @if(auth()->user()->type === 'admin')
                            <a href="{{ url('/home') }}" class=""><button class="btn btn-primary">Home</button></a>
                            @elseif(auth()->user()->type === 'judge')
                            <a href="{{ url('/Judge-Dashboard') }}" class=""><button class="btn btn-primary">Home</button></a>
                            @else(auth()->user()->type === 'user')
                            <a href="{{ url('/user-home') }}" class=""><button class="btn btn-primary">Home</button></a>
                            @endif
                        <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <button class="btn btn-success">Logout</button>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @else
                            <a href="{{ route('login') }}" class=""><button class="btn btn-primary">Log in</button></a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class=""><button class="btn btn-success">Register</button></a>
                            @endif
                        @endauth
                    @endif
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid"> 
            <div class="row justify-content-center">
                <img src="{{ asset('imgs/IT-white.png') }}" class="img-fluid" alt="IT logo" style="width:10%">
                <img src="{{ asset('imgs/IT-white.png') }}" class="img-fluid" alt="IT logo" style="width:10%">
                <img src="{{ asset('imgs/IT-white.png') }}" class="img-fluid" alt="IT logo" style="width:10%">
                <img src="{{ asset('imgs/IT-white.png') }}" class="img-fluid" alt="IT logo" style="width:10%">
                <img src="{{ asset('imgs/IT-white.png') }}" class="img-fluid" alt="IT logo" style="width:10%">
            </div><br>
            <div class="row justify-content-center text-justify text-center" style="font-family: 'Kode Mono', monospace;">
                <p class="display-1 glowing-text">LOCAL I.T.</p><br>
                <p class="display-1 glowing-text">ASSESSMENT</p><br>
                <p class="display-1 glowing-text">FOR YOUTH</p><br>
                <p class="display-1 glowing-text">WITH</p><br>
                <p class="display-1 glowing-text">DISABILITIES</p>
            </div>
        </div>
    </body>
</html>
