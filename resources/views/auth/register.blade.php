@extends('layouts.app')

@section('content')
<div class="col s12 xl10 offset-xl1">
    <div class="card">

        <div class="card-content">
            <div class="card-title">{{ __('Register') }}</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="input-field col s12">
                        <label for="user_id">{{ __('User ID') }}</label>
                        <input id="user_id" type="text" class="@error('user_id') is-invalid @enderror validate" name="user_id" value="{{ old('user_id') }}" required autocomplete="id" data-length="32" autofocus>

                        @error('user_id')
                            <script>M.toast({html: '{{ $message }}'})</script>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <label for="name">{{ __('Name any') }}</label>
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" data-length="32">

                        @error('name')
                            <script>M.toast({html: '{{ $message }}'})</script>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror validate" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <script>M.toast({html: '{{ $message }}'})</script>
                        @enderror
                    </div>
                    <div class="input-field col s6">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror validate" name="password" required autocomplete="new-password">

                        @error('password')
                            <script>M.toast({html: '{{ $message }}'})</script>
                        @enderror
                    </div>
                    <div class="input-field col s6">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="validate" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <a class="waves-effect waves-light btn-flat modal-trigger" href="#modal1">{{ __('Term of service') }}</a>
                        <div id="modal1" class="modal modal-fixed-footer"> 
                            <div class="modal-content">
                                @include('../tos')
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Close') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s10">
                        <label for="term-of-service">
                            <input class="filled-in" type="checkbox" name="term-of-service" id="term-of-service" required>
                            <span>{{ __('Accept Term of service') }}</span>
                        </label>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn right">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        {{ __('Have Account?') }}
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
