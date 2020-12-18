@extends('layouts.app')

@section('title', __('Confirm Password'))

@section('app-title', __('Confirm Password'))

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
                        <input id="password" type="password" class="validate" name="password" required autocomplete="current-password">
                    </div>
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn right">
                            {{ __('Confirm Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
