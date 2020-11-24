@extends('layouts.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">

        <div class="card-content">
            <div class="card-title">{{ __('Confirm Password') }}</div>
            {{ __('Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="row">
                    <div class="input-field col s12">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror validate" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn right">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
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
