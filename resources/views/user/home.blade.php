@extends('layouts.app')

@section('title', __('MyPage'))

@section('app-title', __('MyPage'))

@section('content')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ __('Infomation') }}</div>
            </div>
            <div class="card-action chartist">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ __('New Quiz') }}</div>
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
                            <div class="z-depth-1">
                                <div>{{ __('No New Quiz') }}</div>
                            </div>
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
                <div class="card-title">{{ __('New Quiz') }}</div>
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
                            <div class="z-depth-1">
                                <div>{{ __('No New Quiz') }}</div>
                            </div>
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
