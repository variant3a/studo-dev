@extends('layouts.app')

@section('title', __('Notepad'))
@section('extended-nav', __('Notepad'))

@section('content')
<div class="col s12 xl10 offset-xl1">
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
                        <textarea id="notepad-content" type="text" class="materialize-textarea" name="content"></textarea>
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
    <div id="notepad-hint" class="modal">
        <div class="modal-content">
            <h4>{{ __('Notepad Usage') }}</h4>
            <p>ノートの使い方を紹介します。</p>
            <p>タイトルは任意に設定できます。</p>
            <div class="input-field">
                <input type="text">
                <label for="notepad-title">{{ __('Title') }}</label>
            </div>
            <p>&nbsp;</p>
            <p>本文中の文字を伏せ字にすることができます。</p>
            <p>”[]"（大かっこ）で文字を囲むと、その文字が伏せ字になります。</p>
            <p>また、囲った文字は単語帳に自動的に登録されます。</p>
            <div class="input-field">
                <textarea type="text" class="materialize-textarea"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect waves-light btn-flat" id="confirm-del">{{ __('Close') }}</a>
        </div>
    </div>
    @if ($notes ?? '')
        @foreach ($notes as $note)
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ $note->title }}</div>
                    <div>
                        @php
                            function markerFormatter($contents) {
                                $sqbkt1 = strpos($contents, '[');
                                $sqbkt2 = strpos($contents, ']');
                                $strcnt = $sqbkt1 - $sqbkt2;
                                if($sqbkt1 !== false && $strcnt > 1) {
                                    $words = preg_split("\[|\]", $contents);
                                    foreach ($words as $word) {
                                        if($sqbkt1 == 0) {
                                            $word = '<span class="hidden-text">' . $word . '</span>';
                                            $sqbkt = 1;
                                        } else {
                                            $sqbkt = 0;
                                        }
                                    }
                                    return implode($words);
                                } else {
                                    return $contents;
                                }
                            }
                            echo markerFormatter($note->title);
                        @endphp
                    </div>
                </div>
            </div>    
        @endforeach
    @endif
</div>
<div class="hide-on-med-and-down">
    <div style="position: absolute; bottom: 5%; right: 5%;">
        <a class="btn-floating btn-large waves-effect waves-light" id="add-note-btn"><i class="material-icons">add</i></a>
    </div>
</div>
@endsection
