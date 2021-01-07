@extends('layouts.app')

@section('title', __('Profile'))

@section('app-title', __('Profile'))

@section('content')
    <div class="col s12 xl10 offset-xl1">
        <div id="profile" class="card-panel">
            <div class="row">
                <div class="right">
                    <a class="waves-effect waves-light btn-flat tooltipped" data-position="bottom" data-tooltip="{{ __('Edit profile') }}" id="edit-button"><i class="material-icons">edit</i></a>
                </div>
                <div class="col s12">
                    <div class="center-align">
                        @if (Auth::user()->name !== null)
                            <h3>{{ Auth::user()->name }}</h3>
                        @else
                        <h3>{{ Auth::user()->user_id }}</h3>
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
                    <div class="input-field col s12 m10 offset-m1">
                        <input type="text" value="{{ Auth::user()->name }}" id="name" name="name" data-length="32">
                        <label for="name" class="@if(!(Auth::user()->name)) active @endif">{{ __('Name any') }}</label>
                    </div>
                    <div class="input-field col s12 m10 offset-m1">
                        <input class="@error('user_id') is-invalid @enderror validate" type="text" placeholder="{{ Auth::user()->user_id }}" id="user_id" name="user_id" data-length="32">
                        <label for="user_id" class="active">{{ __('User ID') }}</label>
                    </div>
                    <div class="input-field col s12 m10 offset-m1">
                        <input class="@error('email') is-invalid @enderror validate" type="email" placeholder="{{ Auth::user()->email }}" id="email" name="email">
                        <label for="email" class="active">{{ __('E-Mail Address') }}</label>
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
        <!-------delete account modal------->
        <form method="POST" action="{{ route('delete_account') }}">
            @method('DELETE')
            @csrf
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
                    <button type="submit" class="waves-effect waves-light btn red disabled" id="confirm-del">{{ __('Delete') }}</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-content">
                <div class="card-title center">{{ __('Statistics') }}</div>
                <div class="row">
                    <table class="highlight">
                        <tr>
                            <th colspan="3">{{ __('Account') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('Account Create Date') }}</td><td>{{ date('Y' . __('Year') . 'm' . __('Month') . 'd' . __('Days') . ' H:i:s', strtotime($user->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Account Update Date') }}</td><td>{{ date('Y' . __('Year') . 'm' . __('Month') . 'd' . __('Days') . ' H:i:s', strtotime($user->updated_at)) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Account Lifetime') }}</td><td>{{ date('j' . __('Days'), $now - strtotime($user->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3">{{ __('Timer') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('Number of Timer Records') }}</td><td>@if(is_countable($timer)) {{ count($timer) }} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td>{{ __('Total Study Time') }}</td><td>{{ gmdate('H' . __('hours') . 'i' . __('minutes') . 's' . __('secs'), $total_study_time) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3">{{ __('Notepad') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('Number of Notes') }}</td><td>@if(is_countable($notes)) {{ count($notes) }} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <th colspan="3">{{ __('Quiz') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('Number of Quizzes') }}</td><td>@if(is_countable($quizzes)) {{ count($quizzes) }} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td>{{ __('Accuracy Rate') }}</td><td></td>
                        </tr>
                    </table>
                </div>    
            </div>
        </div>
    </div>
@endsection