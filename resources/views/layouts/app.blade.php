<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#slide-out" data-target="slide-out" class="sidenav-trigger  show-on-small"><i class="material-icons">menu</i></a>
            <a class="brand-logo center" href="@auth {{ route('home') }} @else {{ url('/') }} @endauth">{{ config('app.name', 'Studo!') }}</a>
            
            <!-------pc/tab navigation bar------->
            <ul class="right hide-on-med-and-down">

                <!-------user navigation------->
                @auth
                <li><a href="{{ route('timer') }}">{{ __('Timer') }}</a></li>
                <li><a class="dropdown-trigger" href="#" data-target="dropdown1">{{ Auth::user()->user_id . __('San') }}</a>
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        <li class="divider" tabindex="-1"></li>
                        <li><a href="{{ url('/') }}">{{ __('TopPage') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                        </form>
                    </ul>
                </li>

                <!-------guest navigation------->
                @else
                <li><a href="{{ url('/') }}">{{ __('TopPage') }}</a></li>
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @endauth
            </ul>
            
            <!-------smartphone side navigation------->
            <ul id="slide-out" class="sidenav">

                <!-------user navigation------->
                @auth
                <li>
                    <div class="user-view">
                        <div class="background">
                            
                        </div>
                    </div>
                    <a href="{{ route('profile') }}"><span>{{ Auth::user()->user_id . __('San') }}</span></a>
                </li>
                <li><a href="{{ route('timer') }}">{{ __('Timer') }}</a></li>                
                <li class="divider"></li>
                <li><a href="{{ url('/') }}">{{ __('TopPage') }}</a></li>
                <li class="divider"></li>
                <li><a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                    @csrf
                </form>

                <!-------guest navigation------->
                @else
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li class="divider"></li>
                <li><a href="{{ url('/') }}">{{ __('TopPage') }}</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    
    <!-------content------->
    <main>
        @yield('content')
    </main>
</body>
</html>
