@extends('layouts.site')

@section('title', __('TopPage'))
@section('description', 'トップページの説明が入ります')

@section('content')
    <div class="container" style="min-height:80vh;">
        &nbsp;
        <div class="row">
            <div class="col s12 center">
                <h5>プログラマーのための<br>
                プログラミング勉強サポートアプリ</h5>
            </div>
        </div>
        <div class="row">
            <div class="center">
                <h3>はじめる</h3>
                <a href="{{ route('login') }}" class="waves-effect waves-light btn-large">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="waves-effect waves-light btn-large">{{ __('Register') }}</a>
            </div>
        </div>
    </div>
@endsection