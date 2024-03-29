<nav class="navbar navbar-expand-md navbar-light bg-transparent">
    <div class="container">
        @if(auth()->check())
            @if(auth()->user()->type === 'admin')
                <a class="navbar-brand" href="{{ url('home') }}">
            @elseif(auth()->user()->type === 'user')
                <a class="navbar-brand" href="{{ url('user-home') }}">
            @elseif(auth()->user()->type === 'superadmin')
                <a class="navbar-brand" href="{{ url('superadmin-dashboard') }}">
            @else
                <a href="{{ url('Judge-Dashboard') }}" class="navbar-brand">
            @endif
        @endif
            <img src="{{ asset('imgs/IT-white.png') }}" style="width:10%" alt="Image">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <h4>{{ Auth::user()->name }}</h4>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @yield('navbar-links')
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
