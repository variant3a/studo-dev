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
@endphp
@extends('layouts.app')

@section('title', __('Quiz'))

@section('content')
<div class="row">
    this is quiz page.
</div>
@endsection
