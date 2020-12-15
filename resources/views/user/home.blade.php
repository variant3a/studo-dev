@extends('layouts.app')

@section('title', __('MyPage'))

@section('nav-content')
<ul class="tabs tabs-transparent">
    <li class="tab col s3"><a class="active" href="#test1">Test 1</a></li>
    <li class="tab col s3"><a href="#test2">Test 2</a></li>
    <li class="tab col s3"><a href="#test3">Test 3</a></li>
    <li class="tab col s3"><a href="#test4">Test 4</a></li>
</ul>
@endsection

@section('content')
<div id="test1" class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('MyPage') }}</div>
            <div class="card-content">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
<div id="test2" class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('MyPage') }}</div>
            <div class="card-content">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
<div id="test3">test3</div>
<div id="test4">test4</div>
@endsection
