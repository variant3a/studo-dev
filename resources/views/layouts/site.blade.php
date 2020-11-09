<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div id="app">
        @if (Route::has('login'))
        <!-------navbar------->
        <nav>
            <div class="nav-wrapper">
                <a href="#slide-out" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="{{ url('/') }}" class="brand-logo center">{{ config('app.name', 'Studo!') }}</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    @auth
                    <li><a href="{{ url('/home') }}" class="">ホーム</a></li>
                    @else
                    <li><a href="{{ route('login') }}" class="">{{ __('Login') }}</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="">{{ __('Register') }}</a></li>
                    @endif
                    @endif
                </ul>
                <ul id="slide-out" class="sidenav show-on-small">
                    @auth
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
                    @else
                    <li><a href="{{ route('login') }}" class="">{{ __('Login') }}</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="">{{ __('Register') }}</a></li>
                    @endif
                    @endif
                </ul>
            </div>
        </nav>
        @endif

        <!-------content------->
        <div class="container" style="min-height:80vh;">
            @yield('content')
        </div>

        <!-------footer------->
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
                            <li><a href="#" class="grey-text text-lighten-3">リンク3</a></li>
                        </ul>
                    </div>
                    <div class="col s12 l4">
                        <h5 class="white-text">その他</h5>
                        <ul>
                            <li><a href="{{ url('../privacy') }}" class="grey-text text-lighten-3">利用規約・プライバシーポリシー</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    &copy; 2020 Yuma Nishimura
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
