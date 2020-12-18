@php
//$notepad_usage = file_get_contents('../../notepad_usage.md');
$markdown = new Parsedown();
$markdown
    ->setBreaksenabled(true)
    ->setSafeMode(true)
    ->setUrlsLinked(false);
@endphp

@extends('layouts.app')

@if ($note->title)
    @section('title', __('Edit Note') . ' - ' . $note->title)
@else
    @section('title', __('Edit Note') . ' - ' . __('No Title'))
@endif

@section('app-title', __('Edit Note'))

@section('content')
&nbsp;
<form method="POST" action="{{ route('update_note', $note->id) }}">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col s12">
            <div class="left">
                <a href="{{ route('notepad_details', $note->id) }}" class="waves-effect waves-red btn-flat tooltipped" id="cancel-edit-note-btn" data-position="bottom" data-tooltip="{{ __('Cancel') }}"><i class="material-icons">cancel</i></a>
            </div>
            <div class="right">
                <button type="submit" href="#delete-note" class="waves-effect waves-light btn tooltipped" data-position="bottom" data-tooltip="{{ __('Save') }}"><i class="material-icons">save</i></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content" style="word-wrap: break-word">
                    <div class="row">
                        <div class="input-field col s12">
                            @if ($note->title)
                                <input name="title" class="card-title" placeholder="{{ $note->title }}">
                            @else
                                <input name="title" class="card-title" placeholder="{{ __('No Title') }}">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="content" id="update-note-content" class="materialize-textarea validate" required>{{ $note->content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</form>
@endsection
