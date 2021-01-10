@extends('layouts.app')

@section('title', __('MyPage'))

@section('app-title', __('MyPage'))

@section('content')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                @if (\Carbon\Carbon::now()->format('H') <= 10 && \Carbon\Carbon::now()->format('H') >= 4)
                    <div class="card-title">{{ __('Good Morning,') . Auth::user()->user_id . __('San') }}</div>
                @elseif (\Carbon\Carbon::now()->format('H') <= 18)
                    <div class="card-title">{{ __('Good Afternoon,') . Auth::user()->user_id . __('San') }}</div>
                @else
                    <div class="card-title">{{ __('Good Evening,') . Auth::user()->user_id . __('San') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12 m6 l12 xl6">
        <div class="card">
            <div class="card-content" style="word-wrap: break-word">
                <div class="card-title">{{ __('New Post') . ' - ' . __('Global') }}</div>
                @forelse ($global_quizzes as $global_quiz)
                    <div class="card-action">
                        <div class="row">
                            <div class="col s12">
                                @if ($global_quiz->title)
                                    <a href="{{ route('quiz_details', $global_quiz->id) }}" class="col s12 card-title waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('Offer') . $loop->iteration . ' : ' . $global_quiz->title }}</a>
                                @else
                                    <a href="{{ route('quiz_details', $global_quiz->id) }}" class="col s12 card-title waves-effect waves-green btn-flat grey-text tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('Offer') . $loop->iteration . ' : ' . __('No Title') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <span class="global-question" data-value="{{ $global_quiz->question }}"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
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
                @empty
                    <div class="card-action">
                        <div class="col s12">
                            <div>{{ __('No New Quiz') }}</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col s12 m6 l12 xl6">
        <div class="card">
            <div class="card-content" style="word-wrap: break-word">
                <div class="card-title">{{ __('Review Quiz Offer') }}</div>
            </div>
            @forelse ($my_quizzes as $my_quiz)
                <div class="card-action">
                    <div class="row">
                        <div class="col s12">
                            @if ($my_quiz->title)
                                <a href="{{ route('quiz_details', $my_quiz->id) }}" class="col s12 card-title waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('Offer') . $loop->iteration . ' : ' . $my_quiz->title }}</a>
                            @else
                                <a href="{{ route('quiz_details', $my_quiz->id) }}" class="col s12 card-title waves-effect waves-green btn-flat grey-text tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('Offer') . $loop->iteration . ' : ' . __($global_quiz->subject_name) }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <span class="my-question" data-value="{{ $my_quiz->question }}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
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
            @empty
                <div class="card-action">
                    <div class="row">
                        <div class="col s12 l10 offset-l1">
                            <div>{{ __('No New Quiz') }}</div>
                        </div>
                    </div>
                </div>
            @endforelse
            <div class="card-action">

            </div>
        </div>
    </div>
</div>
@endsection
