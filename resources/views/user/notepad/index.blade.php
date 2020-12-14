@extends('layouts.app')

@section('title', __('Notepad'))

@section('content')
<div class="col s12 xl8 offset-xl2">
    <div class="card" id="add-note-card">
        <div class="card-content">
            <form method="POST" action="{{ route('create_note') }}">
                @csrf
                <div class="row">
                    <div class="card-title">{{ __('New Create') }}</div>
                    <div class="input-field">
                        <input id="notepad-title" type="text" name="title">
                        <label for="notepad-title">{{ __('Title') }}</label>
                    </div>
                    <div class="input-field">
                        <textarea id="notepad-content" type="text" class="materialize-textarea validate" name="content" style="max-height: 50vh"></textarea>
                    </div>
                </div>
                <div class="row">
                    <a href="#notepad-hint" class="waves-effect waves-light btn-flat modal-trigger tooltipped" id="store-notes" data-position="top" data-tooltip="{{ __('Hint') }}"><i class="material-icons">info_outline</i></a>
                    <div class="right">
                        <button type="submit" class="waves-effect waves-light btn" id="store-notes">{{ __('Save') }}</button>
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
    {{ $notes->links() }}
</div>
<div class="row">
    @forelse ($notes as $note)
    @include('user/notepad/note_module',  ['target' => 'index'])
    @empty
    <div class="col s12" id="no-notes-text">
        <p>{{ __('No Notes') }}</p>
    </div>
    @endforelse
</div>
<div class="row">
    {{ $notes->links() }}
</div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light tooltipped" id="add-note-btn" data-position="left" data-tooltip="{{ __('Create Notepad') }}"><i class="material-icons">add</i></a>
</div>
<div class="tap-target" data-target="add-note-btn">
    <div class="tap-target-content">
        <h5>{{ __('Add Notes') }}</h5>
        <p>{{ __('Tap + To Start Create Notes') }}</p>
    </div>
</div>
@endsection
