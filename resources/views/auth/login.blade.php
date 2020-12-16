@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('Login') }}</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">

                    <div class="input-field col s12">
                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="input-field col s12">
                        <label for="password" class="">{{ __('Password') }}</label>
                        <input id="password" type="password" class="validate" name="password" required autocomplete="current-password">
                    </div>
                    <div class="col s10">
                        <label for="remember">
                            <input class="filled-in" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                    </div>
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn right">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="col s12">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection
