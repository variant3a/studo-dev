@extends('layouts.app')

@if ($quiz->title)
    @section('title', $quiz->title . ' | ' . __('Quiz'))
@else
    @section('title', __('No Title') . ' | ' . __('Quiz'))
@endif

@section('app-title', __('Quiz Details'))

@section('content')
&nbsp;
<div class="row">
    <div class="col s12">
        <div class="left">
            <a href="{{ route('quiz') }}" class="waves-effect waves-green btn-flat tooltipped" data-position="bottom" data-tooltip="{{ __('Back To List') }}"><i class="material-icons">arrow_back</i></a>
        </div>
        <div class="right">
            @if ($quiz->user_id == Auth::user()->id)
                <a href="#delete-quiz" class="waves-effect waves-light btn red modal-trigger tooltipped" data-position="bottom" data-tooltip="{{ __('Delete') }}"><i class="material-icons">delete</i></a>
                <form method="POST" action="{{ route('delete_quiz', $quiz->id) }}">
                    @method('DELETE')
                    @csrf
                    <div id="delete-quiz" class="modal">
                        <div class="modal-content">
                            <h4>{{ __('Attention!') }}</h4>
                            <p>{{ __('Are you sure you want to delete this post?') }}</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="modal-close waves-effect btn-flat">{{ __('Cancel') }}</a>
                            <button type="submit" class="waves-effect waves-light btn red">{{ __('Delete') }}</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        @if($quiz->title)
                            <span class="card-title">{{ $quiz->title }}</span>
                        @else
                            <span class="card-title grey-text">{{ __('No Title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <span class="question details" data-value="{{ $quiz->question }}"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="grey-text">
                            <div class="left">
                                @if ($quiz->subject_name)
                                    <div>{{ __('Subject Name') . ': ' . __($quiz->subject_name) }}</div>
                                @else
                                    <div>{{ __('Subject Name') . ': ' . __('No Selected') }}</div>
                                @endif
                            </div>
                            <div class="right">
                                @if($quiz->attempt_count)
                                    <div>{{ __('Accuracy Rate') . (int)($quiz->correct_count / $quiz->attempt_count * 100) . '%' }} </div>
                                @else
                                    <div>{{ __('No Challenger') }} </div>
                                @endif
                            </div>
                            <input class="quiz-id" type="hidden" value="{{ $quiz->id }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action" id="answer-input-container">
                <div class="row">
                    <div class="col s12" id="answer-input"></div>
                </div>
            </div>
            <div class="card-action" id="answer-container" data-count="{{ $quiz->number_of_answers }}">
                <div class="row">
                    <div class="col s12">
                        <span id="answer-list"></span>
                    </div>
                </div>
            </div>
            <div class="card-action" id="answer-result">
                <div class="row">
                    <div class="col s12" id="exp-of-question"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="left">
            <button id="answer-quiz-btn" class="waves-effect waves-light btn">{{ __('Answer') }}</button>
        </div>
        <div class="right">
            <button id="show-answer-btn" class="waves-effect waves-green btn-flat">{{ __('Show Answer') }}</button>
        </div>
    </div>
</div>
@endsection
