@extends('layouts.app')

@if ($note->title)
    @section('title', $note->title . ' | ' . __('Notepad'))
@else
    @section('title', __('No Title') . ' | ' . __('Notepad'))  
@endif

@section('app-title', __('Notepad Details'))

@section('content')
&nbsp;
<div class="row">
    <div class="col s12">
        <div class="left">
            <a href="{{ route('notepad') }}" class="waves-effect waves-green btn-flat tooltipped" data-position="bottom" data-tooltip="{{ __('Back To List') }}"><i class="material-icons">arrow_back</i></a>
        </div>
        <div class="right">
            <a href="{{ route('edit_note', $note->id) }}" class="waves-effect btn-flat green-text tooltipped" id="edit-note-btn" data-position="bottom" data-tooltip="{{ __('Edit') }}"><i class="material-icons">edit</i></a>
            <a href="#delete-note" class="waves-effect waves-light btn red modal-trigger tooltipped" data-position="bottom" data-tooltip="{{ __('Delete') }}"><i class="material-icons">delete</i></a>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('delete_note', $note->id) }}">
    @method('DELETE')
    @csrf
    <div id="delete-note" class="modal">
        <div class="modal-content">
            <h4>{{ __('Attention!') }}</h4>
            <p>{{ __('Delete This Note?') }}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
            <button type="submit" class="waves-effect waves-light btn red">{{ __('Delete') }}</button>
        </div>
    </div>
</form>
<div class="row">
    @include('user/notepad/note_module',  ['target' => 'show'])
</div>
@endsection
