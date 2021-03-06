@extends('layouts.app')

@section('title', __('Timer'))

@section('app-title', __('Timer'))

@section('content')

@php
    $markdown = new Parsedown();
    $markdown
        ->setBreaksenabled(true)
        ->setSafeMode(true)
        ->setUrlsLinked(false);
@endphp
<div class="col s10 offset-s1 m8 offset-m2 xl6 offset-xl3">
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="center">
            <div id="timer-1"></div>
            <div class="progressbar-text"></div>
        </div>
    </div>
    <div class="row">
        <div class="center">
            <button class="waves-effect waves-light btn-large disabled" id="timer-end-button"></button>
            <button class="waves-effect waves-light btn-large" id="timer-start-button"></button>
        </div>
    </div>
    <div class="row">
        <div class="input-field">
            <select name="subjects" id="subjects">
                <option value="" selected>{{ __('Choose Your Option Any') }}</option>
                @forelse ($subjects as $subject)
                    <option value="{{ $subject->subject_name }}" @if (old('subjects') == $subject->subject_name) selected @endif>{{ __($subject->subject_name) }}</option>
                @empty
                @endforelse
            </select>
            <label>{{ __('Choose Subjects') }}</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field">
            <select name="minutes" id="minutes">
                <option value="" disabled selected>{{ __('Choose Your Option') }}</option>
                <option value="5" @if (old('minutes') == '5') selected @endif>5{{ __('Minutes') }}</option>
                <option value="30" @if (old('minutes') == '30') selected @endif>30{{ __('Minutes') }}</option>
                <option value="60" @if (old('minutes') == '60') selected @endif>60{{ __('Minutes') }}</option>
                <option value="120" @if (old('minutes') == '120') selected @endif>120{{ __('Minutes') }}</option>
                <option value="240" @if (old('minutes') == '240') selected @endif>240{{ __('Minutes') }}</option>
            </select>
            <label>{{ __('Choose Time') }}</label>
        </div>
    </div>
    <div class="row">
        <a href="#add-subject-modal" id="add-subject" class="modal-trigger">教科が一覧にない場合</a>
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
                            <label>{{ __('Choose Category') }}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
                    <button type="submit" class="modal-close waves-effect waves-light btn" id="create-subject-btn">{{ __('Create') }}</button>
                </div>
            </div>
        </form>
        <a href="#timer-hint" class="waves-effect waves-green btn-flat modal-trigger tooltipped" id="store-notes" data-position="top" data-tooltip="{{ __('Hint') }}"><i class="material-icons">info_outline</i></a>
    </div>
</div>
<div id="timer-hint" class="modal">
    <div class="modal-content modal-fixed-footer markdown-body">
        {!! $markdown->text(file_get_contents(base_path('storage/app/timer_usage.md'))) !!}
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect btn-flat">{{ __('Close') }}</a>
    </div>
</div>
<div class="col s12 xl10 offset-xl1">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <span class="card-title center">{{ __('Record') }}</span>
                <table id="histories" class="highlight centered" data-name="{{ $timer ?? '' }}">
                    <tr>
                        <th class="center">{{ __('Start Time') }}</th>
                        <th class="center">{{ __('Subject') }}</th>
                        <th class="center">{{ __('Total Time') }}</th>
                        <th class="center">{{ __('Delete') }}</th>
                    </tr>
                    <p class="no-recs"></p>
                    @forelse ($timer as $time)
                        <tr class="records" data-id="{{ $time->id }}">
                            <td>{{ date('m/d H:i', $time->started_at) }}</td>
                            <td>{{ __($time->subject_name) ?? __('blank') }}</td>
                            <td>{{ gmdate('H:i:s', ($time->ended_at - $time->started_at)) }}</td>
                            <td><button type="submit" class="waves-effect waves-red btn-flat rec-del-btn" value="{{ $time->id }}"><i class="material-icons">delete</i></button></td>
                        </tr>
                    @empty
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection