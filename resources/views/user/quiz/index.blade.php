@extends('layouts.app')

@section('title', __('Quiz'))

@section('app-title', __('Quiz List'))

@section('nav-content')
<ul class="tabs tabs-transparent">
    <li class="tab col s6"><a class="active" href="#test1">{{ __('Only Mine') }}</a></li>
    <li class="tab col s6"><a href="#test2">{{ __('Global') }}</a></li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col s12 hide-on-med-and-down">
        <ul class="tabs">
            <li class="tab col s6"><a class="active" href="#test1">{{ __('Only Mine') }}</a></li>
            <li class="tab col s6"><a href="#test2">{{ __('Global') }}</a></li>
        </ul>
    </div>
    <div id="test1" class="col s12">
        @forelse ($my_quizzes as $my_quiz)
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <div class="card-title">{{ $my_quiz->title }}</div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col s12">
                            <span id="my-question" data-name="{!! $my_quiz->question !!}"></span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>{{ __('No Quizzes') }}</p>
        @endforelse
    </div>
    <div id="test2" class="col s12">
        @forelse ($global_quizzes as $global_quiz)
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <div class="card-title">{{ $global_quiz->title }}</div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col s12">
                            <span id="global-question" data-name="{!! $global_quiz->question !!}"></span>
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
        <p>{{ __('Tap + To Start Create Quizzes') }}</p>
    </div>
</div>
@endsection
