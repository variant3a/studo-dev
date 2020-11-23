@extends('layouts.app')

@section('content')
    <div class="col s12 xl10 offset-xl1">
        <div id="profile" class="card">
            <div class="card-content">
                <div class="row">
                    <div class="right">
                        <a class="btn-flat tooltipped" data-position="bottom" data-tooltip="{{ __('Edit profile') }}" id="edit-button"><i class="material-icons">edit</i></a>
                    </div>
                    <div class="col s12">
                        <div class="center-align">
                            @if (Auth::user()->name !== null)
                                <h2>{{ Auth::user()->name }}</h2>
                            @else
                            <h2>{{ Auth::user()->user_id }}</h2>
                            @endif
                            <div>{{ '@' . Auth::user()->user_id }}</div>
                            <div>{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-------edit profile------->
        <form method="POST" action="{{ route('profile') }}">
            @csrf
            <div id="edit-profile" class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" value="{{ Auth::user()->name }}" id="name" data-length="32" autofocus>
                            <label for="name" class="@if(!(Auth::user()->name)) active @endif">{{ __('Name any') }}</label>
                        </div>
                        <div class="input-field col s12">
                            <input class="@error('user_id') is-invalid @enderror validate" type="text" value="{{ Auth::user()->user_id }}" id="user_id" data-length="32">
                            <label for="user_id" class="active">{{ __('User ID') }}</label>
                            @error('user_id')
                                <script>M.toast({html: '{{ $message }}'})</script>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <input class="@error('email') is-invalid @enderror validate" type="email" value="{{ Auth::user()->email }}" id="email">
                            <label for="email" class="active">{{ __('E-Mail Address') }}</label>
                            @error('user_id')
                                <script>M.toast({html: '{{ $message }}'})</script>
                            @enderror
                        </div>
                        <div class="col s12">
                            <a class="waves-effect waves-light btn-flat red-text" href="{{ route('password.request') }}">{{ __('Reset Password') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="right">
                                <button type="button" id="cancel-edit" class="waves-effect waves-light btn-flat">{{ __('Cancel') }}</button>
                                <button type="submit" class="waves-effect waves-light btn">{{ __('Save Changes') }}</button>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </form>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s6 l4 center-align">
                        ステータス1
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス2
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス3
                    </div>
                    <div class="col s12 l6 center-align">
                        ステータス4
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス5
                    </div>
                    <div class="col s12 l6 center-align">
                        ステータス6
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection