@extends('layouts.site')

@section('title', __('Term of service'))
@section('description', @include('tos'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 l10 offset-l1">
                @include('tos')
            </div>
        </div>
    </div>
@endsection
