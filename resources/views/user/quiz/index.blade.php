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
<form action="{{ route('quiz') }}" method="GET">
    <div class="col s12 m4">
        <div class="input-field col s12">
            <i class="material-icons prefix">filter_list</i>
            <select name="search-subject">
                <option value="" selected>{{ __('All') }}</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->subject_name }}" @if (old('search-subject') == $subject->subject_name) selected @endif>{{ __($subject->subject_name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col s12 m8">
        <div class="input-field inline col s9">
            <input type="text" id="search-word" name="search-keyword" value="{{ old('search-keyword') }}" autocomplete="off">
            <label for="search-word">{{ __('Keyword') }}</label>
        </div>
        <div class="input-field inline right">
            <button type="submit" class="waves-effect waves-light btn right"><i class="material-icons">search</i></button>
        </div>
    </div>
</form>
<div class="row">
    <div id="my-tabs" class="col s12">
        @forelse ($my_quizzes as $my_quiz)
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <a href="#my-post-dropdown{{ $my_quiz->id }}" class="dropdown-trigger waves-effect waves-light btn-flat right" data-target="my-post-dropdown{{ $my_quiz->id }}"><i class="material-icons">more_vert</i></a>
                            <ul id="my-post-dropdown{{ $my_quiz->id }}" class="dropdown-content">
                                <li><a href="#delete-my-quiz{{ $my_quiz->id }}" class="waves-effect waves-red red-text modal-trigger"><i class="material-icons left">delete</i>{{ __('Delete') }}</a>
                                </li>
                            </ul>
                            <form method="POST" action="{{ route('delete_quiz', $my_quiz->id) }}">
                                @method('DELETE')
                                @csrf
                                <div id="delete-my-quiz{{ $my_quiz->id }}" class="modal">
                                    <div class="modal-content">
                                        <h4>{{ __('Attention!') }}</h4>
                                        <p>{{ __('Are you sure you want to delete this post?') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
                                        <button type="submit" class="waves-effect waves-light btn red">{{ __('Delete') }}</button>
                                    </div>
                                </div>
                            </form>
                            @if ($my_quiz->title)
                                <a href="{{ route('quiz_details', $my_quiz->id) }}" class="card-title waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ $my_quiz->title }}</a>
                            @elseif ($my_quiz->subject_name)
                                <a href="{{ route('quiz_details', $my_quiz->id) }}" class="card-title waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __($my_quiz->subject_name) }}</a>
                            @else
                                <a href="{{ route('quiz_details', $my_quiz->id) }}" class="card-title waves-effect waves-green btn-flat grey-text tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('No Title') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <span class="my-question" data-value="{{ $my_quiz->content }}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="left">
                                <div class="grey-text">
                                    @if ($my_quiz->subject_name)
                                        <div>{{ __('Subject Name') . ': ' . __($my_quiz->subject_name) }}</div>
                                    @else
                                        <div>{{ __('Subject Name') . ': ' . __('No Selected') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="grey-text">{{ $my_quiz->created_at }}</div>
                    </div>
                </div>
                @if ($my_quiz->number_of_answers != 0)
                    <div class="card-action">
                        <a href="{{ route('quiz_details', $my_quiz->id) }}">{{ __('Answer Quiz') }}</a>
                        <div class="grey-text right">
                            @if($my_quiz->attempt_count)
                                <div>{{ __('Accuracy Rate') . (int)($my_quiz->correct_count / $my_quiz->attempt_count * 100) . '%' }} </div>
                            @else
                                <div>{{ __('No Challenger') }} </div>
                            @endif
                        </div>
                    </div>
                @endif
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
                            <a href="#global-post-dropdown{{ $global_quiz->id }}" class="dropdown-trigger waves-effect waves-light btn-flat right" data-target="global-post-dropdown{{ $global_quiz->id }}"><i class="material-icons">more_vert</i></a>
                            @if ($global_quiz->user_id == Auth::user()->id)
                                <ul id="global-post-dropdown{{ $global_quiz->id }}" class="dropdown-content">
                                    <li><a href="#delete-global-quiz{{ $global_quiz->id }}" class="waves-effect waves-red red-text modal-trigger"><i class="material-icons left">delete</i>{{ __('Delete') }}</a>
                                    </li>
                                </ul>
                                <form method="POST" action="{{ route('delete_quiz', $global_quiz->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <div id="delete-global-quiz{{ $global_quiz->id }}" class="modal">
                                        <div class="modal-content">
                                            <h4>{{ __('Attention!') }}</h4>
                                            <p>{{ __('Are you sure you want to delete this post?') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
                                            <button type="submit" class="waves-effect waves-light btn red">{{ __('Delete') }}</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <ul id="global-post-dropdown{{ $global_quiz->id }}" class='dropdown-content'>
                                    <li><a href="#!">{{ __('Follow') }}</a></li>
                                    <form action="{{ route('contact_index') }}" method="GET">
                                        <input type="hidden" name="category" value="{{ __('Report Posts') }}">
                                        <input type="hidden" name="title" value="{{ __('Report Posts') }}">
                                        <input type="hidden" name="content" value="{{ __('User Name: ') . $global_quiz->user_id . "\n" . __('Post URL: ') . route('quiz_details', $global_quiz->id) . "\n" . __('Reasons: ') . "\n" }}">
                                        <li><button type="submit">{{ __('Report This Post') }}</button></li>
                                    </form>
                                </ul>
                            @endif
                            @if($global_quiz->title)
                                <a href="{{ route('quiz_details', $global_quiz->id) }}" class="card-title waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ $global_quiz->title }}</a>
                            @elseif ($global_quiz->subject_name)
                                <a href="{{ route('quiz_details', $global_quiz->id) }}" class="card-title waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __($global_quiz->subject_name) }}</a>
                            @else
                                <a href="{{ route('quiz_details', $global_quiz->id) }}" class="card-title waves-effect waves-green btn-flat grey-text tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('No Title') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <span class="global-question" data-value="{{ $global_quiz->content }}" data-count="{{ $global_quiz->number_of_answers }}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="left">
                                <div class="grey-text">
                                    @if ($global_quiz->subject_name)
                                        <div>{{ __('Subject Name') . ': ' . __($global_quiz->subject_name) }}</div>
                                    @else
                                        <div>{{ __('Subject Name') . ': ' . __('No Selected') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="grey-text">{{ $global_quiz->created_at }}</div>
                    </div>
                </div>
                @if ($global_quiz->number_of_answers != 0)
                    <div class="card-action">
                        <a href="{{ route('quiz_details', $global_quiz->id) }}">{{ __('Answer Quiz') }}</a>
                        <div class="grey-text right">
                            @if($global_quiz->attempt_count)
                                    <div>{{ __('Accuracy Rate') . (int)($global_quiz->correct_count / $global_quiz->attempt_count * 100) . '%' }} </div>
                            @else
                                <div>{{ __('No Challenger') }} </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="col s12">
                <p>{{ __('No Quizzes') }}</p>
            </div>
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
