@php
    function markerFormatter($contents) {
        $sqbkt1 = mb_strpos($contents, '[');
        $sqbkt2 = mb_strpos($contents, ']');
        $strcnt = $sqbkt2 - $sqbkt1;
        if($sqbkt1 !== false && $strcnt > 1) {
            $words = array_map('htmlentities', preg_split('/[\[\]]/', $contents));
            foreach ($words as &$word) {
                if($sqbkt1 == 0) {
                    $len = str_repeat('●', mb_strlen($word));
                    $word = '<span class="hidden-text">' . $len . '</span>';
                    $sqbkt1 = 1;
                } else {
                    $sqbkt1 = 0;
                }
            }
            return implode($words);
        } else {
            return htmlentities($contents);
        }
    }
    $markdown = new Parsedown();
    $markdown
        ->setBreaksenabled(true)
        ->setMarkupEscaped(true)
        ->setUrlsLinked(false);
@endphp
@extends('layouts.app')

@section('title', __('Notepad'))

@section('content')
<div class="col s12 xl8 offset-xl2">
    <div  class="hide-on-large-only">
        <p>&nbsp;</p>
    </div>
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
                        <textarea id="notepad-content" type="text" class="materialize-textarea validate" name="content" contenteditable></textarea>
                    </div>
                </div>
                <div class="row">
                    <a href="#notepad-hint" class="waves-effect waves-light btn-flat modal-trigger" id="store-notes"><i class="material-icons left">info_outline</i>{{ __('Hint') }}</a>
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
        {!! /*$markdown->text(include('notepad_usage.php'))*/ !!}
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat" id="confirm-del">{{ __('Close') }}</a>
    </div>
</div>
<div class="row">
    @if ($notes ?? '')
        @foreach ($notes as $note)
        <div class="col s12">
            <div class="card waves-effect waves-block">
                <div class="card-content" style="word-wrap: break-word">
                    @if (isset($note->title))
                        <div class="card-title">{{ $note->title }}</div>
                    @else
                        <div class="card-title grey-text">{{ __('No Title') }}</div>
                    @endif
                    <script>hljs.initHighlightingOnLoad()</script>
                    <div class="marked-body">{!! $markdown->text($note->content) !!}</div>
                    <div class="grey-text right">{{ $note->updated_at->format('Y-m-d H:i') }}</div>
                </div>
            </div>    
        </div>
        @endforeach
    @endif
</div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light" id="add-note-btn"><i class="material-icons">add</i></a>
</div>
@endsection
