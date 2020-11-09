@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="center">
            <h3>はじめる</h3>
            <a href="{{ url('login') }}" class="waves-effect waves-light btn-large">{{ __('Login') }}</a>
            <a href="{{ url('register') }}" class="waves-effect waves-light btn-large">{{ __('Register') }}</a>
        </div>
    </div>
@endsection