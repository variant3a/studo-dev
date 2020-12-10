@php
    function markerFormatter($contents) {
        $sqbkt1 = mb_strpos($contents, '[');
        $sqbkt2 = mb_strpos($contents, ']');
        $strcnt = $sqbkt2 - $sqbkt1;
        if($sqbkt1 !== false && $strcnt > 1) {
            $words = preg_split("/[\[\]]/", $contents);
            foreach ($words as &$word) {
                //htmlentities($word);
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
            return $contents;
        }
    }
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
                        <textarea id="notepad-content" type="text" class="materialize-textarea" name="content" contenteditable></textarea>
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
        <h4>{{ __('Notepad Usage') }}</h4>
        <p>ノートの使い方を紹介します。</p>
        <p>&nbsp;</p>
        <p>タイトルは任意に設定できます。</p>
        <div class="input-field">
            <input type="text" placeholder="{{ __('Any') }}" autofocus>
            <label for="notepad-title">{{ __('Title') }}</label>
        </div>
        <p>&nbsp;</p>
        <p>本文中の文字を伏せ字にすることができます。</p>
        <p>”[]"（大かっこ）で文字を囲むと、その文字が伏せ字になります。</p>
        <p>また、囲った文字は単語帳に自動的に登録されます。</p>
        <div class="input-field">
            <textarea type="text" class="materialize-textarea">hogehoge[huga]huga</textarea>
        </div>
        <p>=> hogehoge▒▒▒▒huga</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-light btn-flat" id="confirm-del">{{ __('Close') }}</a>
    </div>
</div>
<div class="row">
    @if ($notes ?? '')
        @foreach ($notes as $note)
        <div class="col s12 m6 l12 xl6">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ $note->title }}</div>
                    <div>
                        {!! nl2br(markerFormatter($note->content)) !!}
                    </div>
                    <div class="grey-text right">{{ $note->updated_at->format('Y-m-d H:i') }}</div>
                </div>
            </div>    
        </div>
        @endforeach
    @endif
</div>
<div style="position: fixed; bottom: 5%; right: 5%;">
    <a class="btn-floating btn-large waves-effect waves-light" id="add-note-btn"><i class="material-icons">add</i></a>
</div>
@endsection
