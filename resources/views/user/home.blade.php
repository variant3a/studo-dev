@extends('layouts.app')

@section('content')
@if (session('status'))
<script>M.toast({html: '{{ session('status') }}'});</script>
@endif
<div class="col s12 xl10 offset-xl1">
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ __('MyPage') }}</div>
            <div class="card-content">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
@endsection
