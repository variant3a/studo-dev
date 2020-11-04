<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    </head>

    <body>
        @if (Route::has('login'))
            <nav>
                <div class="nav-wrapper">
                    <a href="{{ url('/') }}" class="brand-logo center">Studo!</a>
                    <ul id="nav-mobile" class="right hide-on-small-only">
                        @auth
                            <li><a href="{{ url('/home') }}" class="">ホーム</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="">ログイン</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="">新規登録</a></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </nav>
        @endif

        <div class="container" style="min-height:80vh;">
            <div class="row">
                <div class="center">
                    <h3>はじめる</h3>
                    <a href="{{ url('register') }}" class="waves-effect waves-light btn-large">新規登録</a>
                </div>
            </div>
        </div>

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
                            <li><a href="{{ url('privacy')}}" class="grey-text text-lighten-3">利用規約・プライバシーポリシー</a></li>
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
    </body>

    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
</html>
