@extends('layouts.app')

@section('title', __('New Create') . ' | ' . __('Quiz'))

@section('app-title', __('Create New Quiz'))

@section('content')
&nbsp;
<div class="row">
    <div class="col s12">
        <div class="left">
            <a href="{{ route('quiz') }}" class="waves-effect waves-green btn-flat tooltipped" data-position="bottom" data-tooltip="{{ __('Back To List') }}"><i class="material-icons">arrow_back</i></a>
        </div>
    </div>
</div>
<div class="col s12 xl8 offset-xl2">
    <div class="card" id="add-quiz-card">
        <div class="card-content">
            <form method="POST" action="{{ route('store_quiz') }}">
                @csrf
                <div class="row">
                    <div class="col s12">
                        <span class="card-title">{{ __('New Create') }}</span>
                        <div class="input-field">
                            <input id="quiz-title" type="text" name="title" autocomplete="off" data-length="32">
                            <label for="quiz-title">{{ __('Title') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field">
                            <textarea id="quiz-content" type="text" class="materialize-textarea validate" name="content" style="overflow:auto; min-height: 10vh; max-height: 50vh" autocomplete="off" data-length="255" required></textarea>
                            <label for="notepad-content">{{ __('Main Context') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="switch">
                            <label>
                                {{ __('Publishing Settings') }}
                                <input type="checkbox" name="publishing_settings" value="1">
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <select name="subjects" id="subjects">
                            <option value="" selected>{{ __('Choose Your Option Any') }}</option>
                            @forelse ($subjects as $subject)
                                <option value="{{ $subject->subject_name }}">{{ __($subject->subject_name) }}</option>
                            @empty
                            @endforelse
                        </select>
                        <label>{{ __('Choose Subjects') }}</label>
                    </div>
                </div>
                <a href="#add-subject-modal" id="add-subject" class="modal-trigger">教科が一覧にない場合</a>
                <div class="row">
                    <div class="col s12">
                        <a href="#quiz-hint" class="waves-effect waves-green btn-flat modal-trigger tooltipped" id="store-quizs" data-position="top" data-tooltip="{{ __('Hint') }}"><i class="material-icons">info_outline</i></a>
                        <div class="right">
                            <button type="submit" class="waves-effect waves-light btn" id="store-quizs">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
                    <label>{{ __('Choose Time') }}</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect btn-flat">{{ __('Cancel') }}</a>
            <button type="submit" class="modal-close waves-effect waves-light btn" id="create-subject-btn">{{ __('Create') }}</button>
        </div>
    </div>
</form>
<div id="quiz-hint" class="modal">
    <div class="modal-content">

    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect btn-flat">{{ __('Close') }}</a>
    </div>
</div>
@endsection
