@extends('layouts.app')

@section('title', __('Timer'))

@section('content')
<div class="col s10 offset-s1 m8 offset-m2 xl6 offset-xl3">
    <div class="center">
        <div id="timer-1"></div>
        <div class="progressbar-text"></div>
    </div>
</div>
<div class="col s10 offset-s1 m8 offset-m2 xl6 offset-xl3">
    <div class="card">
        <div class="card-content">
            <span class="card-title">{{ __('Select Timer Count') }}</span>
        </div>
    </div>
</div>
@endsection