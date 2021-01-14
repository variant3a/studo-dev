@extends('layouts.app')

@section('title', __('Notepad'))

@section('app-title', __('Note List'))

@section('content')

@php
    $markdown = new Parsedown();
    $markdown
        ->setBreaksenabled(true)
        ->setSafeMode(true)
        ->setUrlsLinked(false);
@endphp
<div class="col s12 xl8 offset-xl2">
    <div class="card" id="add-note-card">
        <div class="card-content">
            <form method="POST" action="{{ route('create_note') }}">
                @csrf
                <div class="row">
                    <div class="col s12">
                        <div class="card-title">{{ __('New Create') }}</div>
                        <div class="input-field">
                            <input id="notepad-title" type="text" name="title" value="{{ old('title') }}" autocomplete="off">
                            <label for="notepad-title">{{ __('Title') }}</label>
                        </div>
                        <div class="input-field">
                            <textarea id="notepad-content" type="text" class="materialize-textarea validate" name="content" style="overflow:auto; min-height: 20vh; max-height: 50vh" autocomplete="off" required>{{ old('content') }}</textarea>
                            <label for="notepad-content">{{ __('Main Context') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <select name="subjects" id="subjects">
                            <option value="" selected>{{ __('Choose Your Option Any') }}</option>
                            @forelse ($subjects as $subject)
                                <option value="{{ $subject->subject_name }}" @if (old('subjects') == $subject->subject_name) selected @endif>{{ __($subject->subject_name) }}</option>
                            @empty
                            @endforelse
                        </select>
                        <label>{{ __('Choose Subjects') }}</label>
                        <a href="#add-subject-modal" id="add-subject" class="modal-trigger">教科が一覧にない場合</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <a href="#notepad-hint" class="waves-effect waves-green btn-flat modal-trigger tooltipped" id="store-notes" data-position="top" data-tooltip="{{ __('Hint') }}"><i class="material-icons">info_outline</i></a>
                        <div class="right">
                            <button type="submit" class="waves-effect waves-light btn" id="store-notes">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
                    <label>{{ __('Choose Time') }}</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect btn-flat">{{ __('Cancel') }}</a>
            <button type="submit" class="modal-close waves-effect waves-light btn" id="create-subject-btn">{{ __('Create') }}</button>
        </div>
    </div>
</form>
<div id="notepad-hint" class="modal">
    <div class="modal-content markdown-body">
        {!! $markdown->text(file_get_contents(base_path('storage/app/notepad_usage.md'))) !!}
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect btn-flat" id="confirm-del">{{ __('Close') }}</a>
    </div>
</div>
<div class="row">
    <div class="row">
        {{ $notes->links() }}
    </div>
    <form action="{{ route('notepad') }}" method="GET">
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
    @forelse ($notes as $note)
    @include('user/notepad/note_module',  ['target' => 'index'])
    @empty
    <div class="col s12" id="no-notes-text">
        <p>{{ __('No Notes') }}</p>
    </div>
    @endforelse
    <div class="row">
        {{ $notes->links() }}
    </div>
</div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light pulse tooltipped" id="add-note-btn" data-position="left" data-tooltip="{{ __('Create Notepad') }}"><i class="material-icons">add</i></a>
</div>
<div class="tap-target" data-target="add-note-btn">
    <div class="tap-target-content">
        <h5>{{ __('Add Notes') }}</h5>
        <p>{{ __('Tap + To Start Create Notes') }}</p>
    </div>
</div>
@endsection
