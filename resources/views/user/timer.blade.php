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
            <span class="card-title">{{ __('Option') }}</span>
            <div class="input-field">
                <select name="minutes" id="minutes">
                    <option value="" disabled selected>{{ __('Choose Your Option') }}</option>
                    <option value="5">5{{ __('Minutes') }}</option>
                    <option value="10">10{{ __('Minutes') }}</option>
                    <option value="20">20{{ __('Minutes') }}</option>
                    <option value="30">30{{ __('Minutes') }}</option>
                    <option value="45">45{{ __('Minutes') }}</option>
                    <option value="60">60{{ __('Minutes') }}</option>
                    <option value="90">90{{ __('Minutes') }}</option>
                    <option value="120">120{{ __('Minutes') }}</option>
                </select>
                <label>{{ __('Choose Time') }}</label>
            </div>
            <button class="waves-effect waves-light btn-large disabled" id="timer-end-button"></button>
            <button class="waves-effect waves-light btn-large" id="timer-start-button"></button>
        </div>
    </div>
</div>
@endsection