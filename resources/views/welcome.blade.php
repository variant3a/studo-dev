@extends('layouts.site')

@section('content')
    <div class="container" style="min-height:80vh;">
        <div class="row">
            <div class="center">
                <h3>はじめる</h3>
                <a href="{{ route('login') }}" class="waves-effect waves-light btn-large">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="waves-effect waves-light btn-large">{{ __('Register') }}</a>
            </div>
        </div>
    </div>
@endsection