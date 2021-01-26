<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#66bb6a">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection ('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    @hasSection ('description')
        <meta name="description" content="@yield('description')">
    @else
        <meta name="description" content="簡単に使える！プログラマーのためのプログラミング勉強サポートアプリ">
    @endif
    <link rel="shortcut icon" href="{{ asset('/favicon_studo_s.ico') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    @if (session('status'))
        <script>M.toast({html: '{{ session('status') }}'});</script>
    @endif
    <div id="app">
        <nav>
            <div class="nav-wrapper">
                <a href="#slide-out" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <!-- pc/tab navigation bar -->
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="{{ route('home') }}" class="waves-effect waves-light"><i class="material-icons right">home</i>{{ __('MyPage') }}</a></li>
                </ul>

                <a href="{{ url('/') }}" class="brand-logo waves-effect waves-light center">{{ config('app.name', 'Studo!') }}</a>

                <!-- pc/tab navigation bar -->
                <ul id="nav-mobile" class="right hide-on-med-and-down">

                    <!-- user navigation -->
                    @auth
                    <li><a class="dropdown-trigger waves-effect waves-light" href="#" data-target="dropdown1">{{ Auth::user()->user_id . __('San') }}<i class="material-icons right">arrow_drop_down</i></a>
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a href="{{ route('profile') }}" class="waves-effect waves-light">{{ __('Profile') }}</a></li>
                            <li><a href="{{ route('logout') }}" class="waves-effect waves-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                            </form>
                        </ul>
                    </li>

                    <!-- guest navigation -->
                    @else
                    <li><a href="{{ route('login') }}" class="">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('register') }}" class="">{{ __('Register') }}</a></li>
                    @endauth
                </ul>

                <!-- martphone side navigation -->
                <ul id="slide-out" class="sidenav show-on-small">

                    <!-- ser navigation -->
                    @auth
                    @include('layouts.user_sidenav')
                    <li class="divider"></li>
                    <li><a href="{{ url('/') }}" class="waves-effect waves-green">{{ __('TopPage') }}</a></li>
                    <li><a href="{{ route('contact_index') }}" class="waves-effect waves-green">{{ __('Contact Us') }}</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}" class="waves-effect waves-red" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>

                    <!-- guest navigation -->
                    @else
                    <li><a href="{{ route('register') }}" class="waves-effect waves-green">{{ __('Register') }}</a></li>
                    <li><a href="{{ route('login') }}" class="waves-effect waves-yellow">{{ __('Login') }}</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/') }}" class="waves-effect waves-green">{{ __('TopPage') }}</a></li>
                    <li><a href="{{ route('contact_index') }}" class="waves-effect waves-green">{{ __('Contact Us') }}</a></li>
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- content --->
        <main>
            @yield('content')
        </main>

        <!-- footer -->
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col s12 l4">
                        <h5 class="white-text">Studoについて</h5>
                        <p>ここに説明が入ります</p>
                    </div>
                    <div class="col s12 l4">
                        <h5 class="white-text">リンク</h5>
                        <ul>
                            <li><a href="#" class="grey-text text-lighten-3">Studoとは？</a></li>
                            <li><a href="{{ route('contact_index') }}" class="grey-text text-lighten-3">{{ __('Contact Us') }}</a></li>
                        </ul>
                    </div>
                    <div class="col s12 l4">
                        <h5 class="white-text">その他</h5>
                        <ul>
                            <li><a href="{{ route('privacy') }}" class="grey-text text-lighten-3">利用規約・プライバシーポリシー</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    &copy; 2020 Team Studo
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
