@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="center">
            <h3>はじめる</h3>
            <a href="{{ url('register') }}" class="waves-effect waves-light btn-large">新規登録</a>
        </div>
    </div>
@endsection