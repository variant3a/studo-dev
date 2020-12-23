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
            <a href="#!" class="waves-effect waves-light btn tooltipped" data-position="bottom" data-tooltip="{{ __('Share') }}"><i class="material-icons">share</i></a>
            @if ($quiz->user_id == Auth::user()->id)
                <a href="#delete-quiz" class="waves-effect waves-light btn red modal-trigger tooltipped" data-position="bottom" data-tooltip="{{ __('Delete') }}"><i class="material-icons">delete</i></a>
                <form method="POST" action="{{ route('delete_quiz', $quiz->id) }}">
                    @method('DELETE')
                    @csrf
                    <div id="delete-quiz" class="modal">
                        <div class="modal-content">
                            <h4>{{ __('Attention!') }}</h4>
                            <p>{{ __('Delete This quiz?') }}</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
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
                        <span class="card-title">{{ $quiz->title }}</span>
                    </div>
                </div>    
                <div class="row">
                    <div class="col s12">
                        <span class="global-question" data-value="{{ $quiz->question }}"></span>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="right">
            <button class="waves-effect waves-light btn-large">{{ __('Answer') }}</button>
        </div>
    </div>
</div>
@endsection
