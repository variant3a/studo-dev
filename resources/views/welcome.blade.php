@extends('layouts.site')

@section('title', __('TopPage'))
@section('description', 'トップページの説明が入ります')

@section('content')
    <div class="parallax-container" style="width: 100vw;top:-5px">
        <div class="parallax"><img src="{{ asset('images/home_background_code.JPG') }}" style="height: 300%"></div>

        <div class="row" style="margin: 5em 0 10em 0">
            <div class="col s12 center white-text">
                <h4 style="text-shadow: black 0 0 5px"><span class="inblock">プログラマーのための</span><br>
                    <span class="inblock">プログラミング勉強</span><span class="inblock">サポート</span><span class="inblock">アプリ</span></h4>
            </div>
            <div class="col s12 center">
                <a href="{{ route('login') }}" class="waves-effect waves-light btn-large">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="waves-effect waves-light btn-large">{{ __('Register') }}</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin: 5em 0">
            <div class="col s12 center">
                <h4>What is Studo?</h4>
                <div class="">Studoでできること</div>
                &nbsp;
                <div class="row">
                    <div class="col s12 m6 l3">
                        <i class="material-icons large amber-text text-darken-1">timer</i>
                        <div class="center">
                            <h5>{{ __('Timer') }}</h5>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <i class="material-icons large amber-text text-darken-1">library_books</i>
                        <div class="center">
                            <h5>{{ __('Notepad') }}</h5>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <i class="material-icons large amber-text text-darken-1">rate_review</i>
                        <div class="center">
                            <h5>{{ __('Quiz') }}</h5>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <i class="material-icons large amber-text text-darken-1">insert_chart</i>
                        <div class="center">
                            <h5><span class="inblock">勉強時間の</span><span class="inblock">記録</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection