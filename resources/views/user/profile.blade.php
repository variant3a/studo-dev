@extends('layouts.app')

@section('content')
@if (session('status'))
<script>M.toast({html: '{{ session('status') }}'});</script>
@endif
    <div class="col s12 xl10 offset-xl1">
        <div id="profile" class="card">
            <div class="card-content">
                <div class="row">
                    <div class="right">
                        <a class="waves-effect waves-light btn-flat tooltipped" data-position="bottom" data-tooltip="{{ __('Edit profile') }}" id="edit-button"><i class="material-icons">edit</i></a>
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
                <!-------edit profile------->
                <form method="POST" action="{{ route('update_profile') }}" id="edit-profile">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" value="{{ Auth::user()->name }}" id="name" name="name" data-length="32">
                            <label for="name" class="@if(!(Auth::user()->name)) active @endif">{{ __('Name any') }}</label>
                        </div>
                        <div class="input-field col s12">
                            <input class="@error('user_id') is-invalid @enderror validate" type="text" placeholder="{{ Auth::user()->user_id }}" id="user_id" name="user_id" data-length="32">
                            <label for="user_id" class="active">{{ __('User ID') }}</label>
                            @error('user_id')
                                <script>M.toast({html: '{{ $message }}'})</script>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <input class="@error('email') is-invalid @enderror validate" type="email" placeholder="{{ Auth::user()->email }}" id="email" name="email">
                            <label for="email" class="active">{{ __('E-Mail Address') }}</label>
                            @error('email')
                                <script>M.toast({html: '{{ $message }}'})</script>
                            @enderror
                        </div>
                        <div class="col s12">
                            <a class="waves-effect waves-light btn-flat red-text" href="{{ route('password.request') }}">{{ __('Reset Password') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l6">
                            <a href="#del-account-modal" id="delete-account" class="waves-effect waves-light btn red modal-trigger">{{ __('Delete Account') }}</a>
                        </div>
                        <div class="col s12 l6">
                            <div class="right">
                                <button type="button" id="cancel-edit" class="waves-effect waves-light btn-flat">{{ __('Cancel') }}</button>
                                <button type="submit" class="waves-effect waves-light btn">{{ __('Save') }}</button>    
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-------delete account modal------->
        <form method="POST" action="{{ route('delete_account') }}">
            <div id="del-account-modal" class="modal">
                <div class="modal-content">
                    <h4>{{ __('Attention!') }}</h4>
                    <p>アカウントを削除すると保存していた記録は全て消去され、Studoの全てのサービスにアクセスできなくなります。</p>
                    <p>{{ __('Check the checkbox below to delete it.') }}</p>
                </div>
                <div class="modal-footer">
                    <p class="left">
                        <label>
                            <input type="checkbox" class="filled-in" id="del-button-activate">
                            <span>{{ __('Checked Notes') }}</span>
                        </label>
                    </p>
                    <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
                    <button type="submit" class="modal-close waves-effect waves-light btn red disabled" id="confirm-del">{{ __('Delete') }}</button>
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