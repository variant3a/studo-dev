@extends('layouts.app')

@section('title', __('New Create') . ' | ' . __('Quiz'))

@section('app-title', __('Create New Quiz'))

@section('content')
<div class="col s12 xl8 offset-xl2">
    <div class="card" id="add-quiz-card">
        <div class="card-content">
            <form method="POST" action="{{ route('store_quiz') }}">
                @csrf
                <div class="row">
                    <div class="col s12">
                        <span class="card-title">{{ __('New Create') }}</span>
                        <div class="input-field">
                            <input id="quiz-title" type="text" name="title">
                            <label for="quiz-title">{{ __('Title') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="input-field">
                            <textarea id="quiz-content" type="text" class="materialize-textarea validate" name="content" style="overflow:auto; min-height: 10vh; max-height: 50vh" required></textarea>
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
                <div class="row">
                    <div class="col s12">
                        <a href="#quiz-hint" class="waves-effect waves-light btn-flat modal-trigger tooltipped" id="store-quizs" data-position="top" data-tooltip="{{ __('Hint') }}"><i class="material-icons">info_outline</i></a>
                        <div class="right">
                            <button type="submit" class="waves-effect waves-light btn" id="store-quizs">{{ __('Save') }}</button>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="quiz-hint" class="modal">
    <div class="modal-content">
        
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">{{ __('Close') }}</a>
    </div>
</div>
@endsection
