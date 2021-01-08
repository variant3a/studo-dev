@extends('layouts.app')

@section('title', __('Profile'))

@section('app-title', __('Profile'))

@section('content')
    <div class="col s12 xl10 offset-xl1">
        <div id="profile" class="card-panel">
            <div class="row">
                <div class="right">
                    <a class="waves-effect btn-flat green-text tooltipped" data-position="bottom" data-tooltip="{{ __('Edit profile') }}" id="edit-button"><i class="material-icons">edit</i></a>
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
                        <a class="waves-effect btn-flat red-text" href="{{ route('password.request') }}">{{ __('Reset Password') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l6">
                        <a href="#del-account-modal" id="delete-account" class="waves-effect waves-light btn red modal-trigger">{{ __('Delete Account') }}</a>
                    </div>
                    <div class="col s12 l6">
                        <div class="right">
                            <button type="button" id="cancel-edit" class="waves-effect btn-flat">{{ __('Cancel') }}</button>
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
                    &nbsp;
                    <p>{{ __('Check the checkbox below to delete it.') }}</p>
                </div>
                <div class="modal-footer">
                    <p class="left">
                        <label>
                            <input type="checkbox" class="filled-in" id="del-button-activate">
                            <span>{{ __('Checked Notes') }}</span>
                        </label>
                    </p>
                    <a href="#" class="modal-close waves-effect btn-flat">{{ __('Cancel') }}</a>
                    <button type="submit" class="waves-effect waves-light btn red disabled" id="confirm-del">{{ __('Delete') }}</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-content">
                <div class="card-title center">{{ __('Infomation Management') }}</div>
                <div class="row">
                    <table class="highlight centered">
                        <tr>
                            <th class="center">{{ __('Subject Name') }}</th>
                            <th class="center">{{ __('Category') }}</th>
                            <th class="center">{{ __('Delete') }}</th>
                        </tr>
                        @forelse ($my_subjects as $my_subject)
                            <tr>
                                <td>{{ $my_subject->subject_name }}</td>
                                @if ($my_subject->category == 1)
                                    <td>{{ __('Programming Language') }}</td>
                                @elseif($my_subject->category == 2)
                                    <td>{{ __('General Subject') }}</td>
                                @else
                                    <td>{{ __('Other') }}</td>
                                @endif
                                <form action="{{ route('delete_subjects', $my_subject->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <td><button type="submit" id="delete-all-subjects" class="waves-effect waves-red btn-flat"><i class="material-icons">delete</i></button></td>
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="center">{{ __('No Added My Subjects.') }}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <div class="row">
                    <a href="#add-subject-modal" id="add-subject" class="waves-effect btn-flat green-text modal-trigger right"><i class="material-icons right">add</i>{{ __('Add Subject') }}</a>
                    <form method="POST" action="{{ route('add_subject') }}">
                        @csrf
                        <div id="add-subject-modal" class="modal">
                            <div class="modal-content">
                                <h4>{{ __('Add Subject') }}</h4>
                                <p>&nbsp;</p>
                                <p>科目が一覧にない場合、自分で追加することができます。</p>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" name="subject_name" id="add-subject-text" class="validate" data-length="50" autocomplete="off">
                                        <label for="add-subject-text">{{ __('Subject Name') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="category" id="select-subject-category">
                                            <option value="1" selected>{{ __('Programming Language') }}</option>
                                            <option value="2">{{ __('General Subject') }}</option>
                                            <option value="3">{{ __('Other') }}</option>
                                        </select>
                                        <label>{{ __('Choose Category') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="modal-close waves-effect btn-flat">{{ __('Cancel') }}</a>
                                <button type="submit" class="modal-close waves-effect waves-light btn" id="create-subject-btn">{{ __('Create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-title center">{{ __('Statistics') }}</div>
                <div class="row">
                    <table class="highlight">
                        <tr>
                            <th colspan="3" class="center">{{ __('Account') }}</th>
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
                            <th colspan="3" class="center">{{ __('Timer') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('Number of Timer Records') }}</td><td>@if(is_countable($timer)) {{ count($timer) }} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <td>{{ __('Total Study Time') }}</td><td>{{ gmdate('H' . __('hours') . 'i' . __('minutes') . 's' . __('secs'), $total_study_time) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="center">{{ __('Notepad') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('Number of Notes') }}</td><td>@if(is_countable($notes)) {{ count($notes) }} @else 0 @endif</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="center">{{ __('Quiz') }}</th>
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