@extends('layouts.site')

@section('title', __('TopPage'))
@section('description', '簡単に使える！プログラマーのためのプログラミング勉強サポートアプリ！')

@section('content')
    <div class="parallax-container" style="width: 100%;top:-5px">
        <div class="parallax"><img src="{{ asset('images/home_background_code.JPG') }}" style="height: 300%"></div>

        <div class="container">
            <div class="row center" style="margin: 5em 0 10em 0">
                <div class="white-text">
                    <h4 style="text-shadow: black 0 0 5px"><span class="inblock">プログラマーのための</span><br>
                    <span class="inblock">プログラミング勉強</span><span class="inblock">サポート</span><span class="inblock">アプリ</span></h4>
                </div>
                <a href="{{ route('login') }}" class="waves-effect waves-light btn-large">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="waves-effect waves-light btn-large">{{ __('Register') }}</a>
            </div>
        </div>
    </div>
    <div class="container center">
        <div class="row top-white-section">
            <div class="col s12">
                <h4>What is Studo?</h4>
                <p>Studoでできること</p>
            </div>
        </div>
        <div class="row top-white-section">
            <div class="col s12 m6 l3">
                <i class="material-icons large amber-text text-darken-1">timer</i>
                <div class="center">
                    <h5>{{ __('Timer') }}</h5>
                    <p>教科を選択し、勉強時間を記録することが出来ます。</p>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <i class="material-icons large amber-text text-darken-1">subject</i>
                <div class="center">
                    <h5>{{ __('Notepad') }}</h5>
                    <p>Markdown記法の使えるノートです。もちろん教科で分けることが可能。</p>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <i class="material-icons large amber-text text-darken-1">rate_review</i>
                <div class="center">
                    <h5>{{ __('Quiz') }}</h5>
                    <p>プログラミングに関するクイズが作成できます。</p>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <i class="material-icons large amber-text text-darken-1">insert_chart</i>
                <div class="center">
                    <h5>勉強記録</h5>
                    <p>勉強に関する各種統計情報が閲覧できます。</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s1 l2 right">
                <a href="{{ route('what_is_studo') }}">{{ __('Studo') . __('Go Details') }}</a>
            </div>
        </div>
        <div class="row top-white-section">
            <div class="col s12">
                <h4>Technical Infomation</h4>
                <p>Studoはこんな技術を利用して設計されています</p>
            </div>
        </div>
        <div class="row top-white-section">
            <div class="col s12 m6">
                <img src="{{ asset('images/laravel-logo.png') }}" alt="laravel-logo" class="responsive-img" width="20%">
                <h5>Laravel 8.x</h5>
                <p>最新のLaravelフレームワークで稼働しています。</p>
                <div class="right">
                    <a href="https://laravel.com" target="_blank"><i class="material-icons right">open_in_new</i>{{ __('Laravel.com') }}</a>
                </div>
            </div>
            <div class="col s12 m6">
                <img src="{{ asset('images/materialize-logo.png') }}" alt="materialize-logo" class="responsive-img" width="20%">
                <h5>Materialize</h5>
                <p>CSSフレームワークにMaterializeを使用。<br>よりモダンに、慣れ親しんだインターフェースに。</p>
                <div class="right">
                    <a href="https://materializecss.com/" target="_blank"><i class="material-icons right">open_in_new</i>{{ __('MaterializeCSS.com') }}</a>
                </div>
            </div>
            <div class="col s12 m6">
                <img src="{{ asset('images/jquery-logo.png') }}" alt="jquery-logo" class="responsive-img" width="20%">
                <h5>jQuery</h5>
                <p>開発速度の向上。メンテナンス性も向上しています。</p>
                <div class="right">
                    <a href="https://jquery.com" target="_blank"><i class="material-icons right">open_in_new</i>{{ __('jQuery.com') }}</a>
                </div>
            </div>
            <div class="col s12 m6">
                <img src="{{ asset('images/heroku-logo.png') }}" alt="heroku-logo" class="responsive-img" width="14%">
                <h5>Heroku</h5>
                <p>クラウドを利用するからどんな時も快適に稼動。</p>
                <div class="right">
                    <a href="https://heroku.com/home" target="_blank"><i class="material-icons right">open_in_new</i>{{ __('Heroku.com') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection