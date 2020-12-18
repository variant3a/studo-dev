@extends('layouts.app')

@section('title', __('Reset Password'))

@section('app-title', __('Reset Password'))

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('Reset Password') }}</div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn right">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
