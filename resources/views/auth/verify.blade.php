@extends('layouts.app')

@section('title', __('Verify Your Email Address'))

@section('app-title', __('Verify Your Email Address'))

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('Verify Your Email Address') }}</div>
            <div class="row">
                <div class="col s12">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}        
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <form class="" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="waves-effect waves-light btn">{{ __('click here to request another') }}</button>
                    </form>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
