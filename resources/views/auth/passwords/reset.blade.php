@extends('layouts.app')

@section('title', __('Reset Password'))

@section('app-title', __('Reset Password'))

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('Reset Password') }}</div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="validate" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="input-field col s12">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="validate" name="password" required autocomplete="new-password">
                    </div>
                    <div class="input-field col s12">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn right">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
