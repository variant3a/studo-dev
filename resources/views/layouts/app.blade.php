<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#slide-out" data-target="slide-out" class="sidenav-trigger  show-on-small"><i class="material-icons">menu</i></a>
            <a class="brand-logo" href="@guest {{ url('/') }} @else {{ route('home') }} @endguest">{{ config('app.name', 'Studo!') }}</a>
            <ul class="right hide-on-med-and-down">
                @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @endif
                @else
                <li><a class="dropdown-trigger" href="#" data-target="dropdown1">{{ Auth::user()->user_id . __('San') }}</a>
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="#">{{ __('Profile') }}</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                        </form>
                    </ul>
                </li>
                @endguest
            </ul>
            <ul id="slide-out" class="sidenav">
                @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @if (Route::has('register'))
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @endif
                @else
                <li>
                    <div class="user-view">
                        <div class="background">

                        </div>
                    </div>
                    <a href="#"><span>{{ Auth::user()->user_id }}</span></a>
                </li>
                <li><a href="#">{{ __('Profile') }}</a></li>
                <li><div class="divider"></div></li>
                <li><a class="subheader">{{ __('Other') }}</a></li>
                <li><a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                        </form>
                    </div>
                @endguest
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
