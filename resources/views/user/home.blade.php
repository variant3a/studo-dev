@extends('layouts.app')

@section('title', __('MyPage'))

@section('app-title', __('MyPage'))

@section('content')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                @if (\Carbon\Carbon::now()->format('H') <= 12)
                    <div class="card-title">{{ __('Good Morning,') . Auth::user()->user_id . __('San') }}</div>
                @elseif (\Carbon\Carbon::now()->format('H') <= 18)
                    <div class="card-title">{{ __('Good Afternoon,') . Auth::user()->user_id . __('San') }}</div>
                @else
                    <div class="card-title">{{ __('Good Evening,') . Auth::user()->user_id . __('San') }}</div>
                @endif
            </div>
            <canvas class="card-action study-time-chart">{{ __('Your Browser Does Not Support Canvas.') }}</canvas>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ __('New Post') }}</div>
                @forelse ($global_quizzes as $global_quiz)
                    <div class="row">
                        <div class="col s12 l10 offset-l1">
                            <div class="z-depth-1">
                                <div>{{ $global_quiz->title }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col s12 l10 offset-l1">
                            <div>{{ __('No New Quiz') }}</div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="card-action">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ __('Review Quiz Offer') }}</div>
                @forelse ($my_quizzes as $my_quiz)
                    <div class="row">
                        <div class="col s12 l10 offset-l1">
                            <div class="z-depth-1">
                                <div>{{ $my_quiz->title }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="row">
                    <div class="col s12 l10 offset-l1">
                        <div>{{ __('No New Quiz') }}</div>
                    </div>
                </div>
            @endforelse
            </div>
            <div class="card-action">

            </div>
        </div>
    </div>
</div>
@endsection
