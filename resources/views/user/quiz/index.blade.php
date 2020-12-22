@extends('layouts.app')

@section('title', __('Quiz'))

@section('app-title', __('Quiz List'))

@section('nav-content')
<ul class="tabs tabs-transparent">
    <li class="tab col s6"><a class="active" href="#my-tabs">{{ __('Only Mine') }}</a></li>
    <li class="tab col s6"><a href="#global-tabs">{{ __('Global') }}</a></li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col s12 hide-on-med-and-down">
        <ul class="tabs">
            <li class="tab col s6"><a class="active" href="#my-tabs">{{ __('Only Mine') }}</a></li>
            <li class="tab col s6"><a href="#global-tabs">{{ __('Global') }}</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div id="my-tabs" class="col s12">
        @forelse ($my_quizzes as $my_quiz)
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <a href="#my-post-dropdown" class="dropdown-trigger waves-effect waves-light btn-flat right" data-target="my-post-dropdown"><i class="material-icons">more_vert</i></a>
                            <ul id='my-post-dropdown' class='dropdown-content'>
                                <li><a href="#!">{{ __('') }}</a></li>
                                <li><a href="#!">two</a></li>
                            </ul>
                            <a href="{{ route('quiz_details', $my_quiz->id) }}" class="card-title waves-effect waves-green btn-flat">{{ $my_quiz->title }}</a>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col s12">
                            <span class="my-question" data-value="{!! $my_quiz->question !!}">{{ $my_quiz->question }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col s12" id="no-quizzes-text">
                <p>{{ __('No Quizzes') }}</p>
            </div>
    @endforelse
    </div>
    <div id="global-tabs" class="col s12">
        @forelse ($global_quizzes as $global_quiz)
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <a href="#global-post-dropdown" class="dropdown-trigger waves-effect waves-light btn-flat right" data-target="global-post-dropdown"><i class="material-icons">more_vert</i></a>
                            <ul id='global-post-dropdown' class='dropdown-content'>
                                <li><a href="#!">{{ __('') }}</a></li>
                                <li><a href="#!">two</a></li>
                            </ul>
                            <a href="{{ route('quiz_details', $global_quiz->id) }}" class="card-title waves-effect waves-green btn-flat">{{ $global_quiz->title }}</a>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col s12">
                            <span class="global-question" data-value="{!! $global_quiz->question !!}">{{ $global_quiz->question }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>{{ __('No Quizzes') }}</p>
        @endforelse
    </div>
</div>

<div class="fixed-action-btn">
    <a href="{{ route('create_quiz') }}" class="btn-floating btn-large waves-effect waves-light pulse tooltipped" id="add-quiz-btn" data-position="left" data-tooltip="{{ __('Create Quiz') }}"><i class="material-icons">add</i></a>
</div>
<div class="tap-target" data-target="add-quiz-btn">
    <div class="tap-target-content">
        <h5>{{ __('Add Quizzes') }}</h5>
        <p>{{ __('Tap + To Start Share Quizzes') }}</p>
    </div>
</div>
@endsection
