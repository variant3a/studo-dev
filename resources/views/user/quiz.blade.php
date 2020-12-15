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

@section('nav-content')
<ul class="tabs tabs-transparent">
    <li class="tab col s3"><a class="active" href="#test1">Test 1</a></li>
    <li class="tab col s3"><a href="#test2">Test 2</a></li>
    <li class="tab col s3"><a href="#test3">Test 3</a></li>
    <li class="tab col s3"><a href="#test4">Test 4</a></li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col s12 hide-on-med-and-down">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#test1">Test 1</a></li>
            <li class="tab col s4"><a href="#test2">Test 2</a></li>
            <li class="tab col s4"><a href="#test3">Test 3</a></li>
            <li class="tab col s4"><a href="#test4">Test 4</a></li>
        </ul>        
    </div>
    <div id="test1" class="col s12">Test 1</div>
    <div id="test2" class="col s12">Test 2</div>
    <div id="test3" class="col s12">Test 3</div>
    <div id="test4" class="col s12">Test 4</div>
</div>
@endsection
