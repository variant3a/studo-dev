@extends('layouts.app')

@section('title', __('MyPage'))

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('MyPage') }}</div>
            <div class="card-content">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
@endsection
