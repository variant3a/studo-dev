@extends('layouts.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m10 offset-m1 l8 offset-l2 col xl6 offset-xl3">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Login') }}</div>
    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
    
                        <div class="row">
    
                            <div class="input-field col s12">
                                <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror validate" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <label for="password" class="">{{ __('Password') }}</label>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror validate" name="password" required autocomplete="current-password">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
    </div>
</div>
@endsection
