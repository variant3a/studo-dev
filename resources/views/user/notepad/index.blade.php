@extends('layouts.app')

@section('title', __('Notepad'))

@section('app-title', __('Note List'))

@section('content')
<div class="col s12 xl8 offset-xl2">
    <div class="card" id="add-note-card">
        <div class="card-content">
            <form method="POST" action="{{ route('create_note') }}">
                @csrf
                <div class="row">
                    <div class="col s12">
                        <div class="card-title">{{ __('New Create') }}</div>
                        <div class="input-field">
                            <input id="notepad-title" type="text" name="title" autocomplete="off">
                            <label for="notepad-title">{{ __('Title') }}</label>
                        </div>
                        <div class="input-field">
                            <textarea id="notepad-content" type="text" class="materialize-textarea validate" name="content" style="overflow:auto; min-height: 20vh; max-height: 50vh" autocomplete="off" required></textarea>
                            <label for="notepad-content">{{ __('Main Context') }}</label>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <select name="subjects" id="subjects">
                            <option value="" selected>{{ __('Choose Your Option Any') }}</option>
                            @forelse ($subjects as $subject)
                                <option value="{{ $subject->subject_name }}">{{ __($subject->subject_name) }}</option>
                            @empty
                            @endforelse
                        </select>
                        <label>{{ __('Choose Subjects') }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <a href="#notepad-hint" class="waves-effect waves-light btn-flat modal-trigger tooltipped" id="store-notes" data-position="top" data-tooltip="{{ __('Hint') }}"><i class="material-icons">info_outline</i></a>
                        <div class="right">
                            <button type="submit" class="waves-effect waves-light btn" id="store-notes">{{ __('Save') }}</button>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="notepad-hint" class="modal">
    <div class="modal-content">
        
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat" id="confirm-del">{{ __('Close') }}</a>
    </div>
</div>
<div class="row">
    <div class="row">
        {{ $notes->links() }}
    </div>
    <form action="{{ route('notepad') }}" method="GET">
        <div class="col s12 m4">
            <div class="input-field inline col s12">
                <i class="material-icons prefix">filter_list</i>
                <select name="search-subject">
                    <option value="" selected>{{ __('All') }}</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->subject_name }}">{{ __($subject->subject_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col s12 m8">
            <div class="input-field inline col s9">
                <input type="text" id="search-word" name="search-keyword" autocomplete="off">
                <label for="search-word">{{ __('Keyword') }}</label>    
            </div>
            <div class="input-field inline right">
                <button type="submit" class="waves-effect waves-light btn right">{{ __('Search') }}</button>
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
@if (!isset($notes))
<div class="tap-target" data-target="add-note-btn">
    <div class="tap-target-content">
        <h5>{{ __('Add Notes') }}</h5>
        <p>{{ __('Tap + To Start Create Notes') }}</p>
    </div>
</div>
@endif
@endsection
