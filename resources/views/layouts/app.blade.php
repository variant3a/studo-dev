<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection ('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <style>html::-webkit-scrollbar{display: none}</style>
</head>

<body>
    @if (session('status'))
        <script>M.toast({html: '{{ session('status') }}'});</script>
    @endif


    <!-------smartphone navigation bar------->
    <div class="hide-on-large-only">
        @hasSection ('nav-content')
            <nav class="nav-extended">
                <div class="nav-wrapper">
                    <a href="#slide-out" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <a class="brand-logo" @guest href="{{ url('/') }}" @endguest >@yield('app-title')</a>
                </div>
                <div class="nav-content">
                    @yield('nav-content')
                </div>
            </nav>
        @else
            <nav>
                <a href="#slide-out" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="brand-logo" @guest href="{{ url('/') }}" @endguest >@yield('app-title')</a>
            </nav>
        @endif
    </div>


    <!-------smartphone side navigation------->
    <ul id="slide-out" class="sidenav sidenav-fixed">

        <!-------user navigation------->
        @auth
        @include('layouts.user_sidenav')
        <li class="divider"></li>
        <li><a href="{{ url('/') }}" class="waves-effect waves-green">{{ __('TopPage') }}</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}" class="waves-effect waves-red" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
            @csrf
        </form>

        <!-------guest navigation------->
        @else
        <li><a href="{{ route('register') }}" class="waves-effect waves-orange">{{ __('Register') }}</a></li>
        <li><a href="{{ route('login') }}" class="waves-effect waves-green">{{ __('Login') }}</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/') }}">{{ __('TopPage') }}</a></li>
        @endauth
    </ul>
    

    <!-------content------->
    <main class="app">
        <div class="container">
            <div class="row">
                @yield('content')    
            </div>
        </div>
    </main>
</body>
</html>
