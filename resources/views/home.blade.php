@extends('layouts.app')

@section('content')
@if (session('status'))
<script>M.toast({html: '{{ session('status') }}'});</script>
@endif
<div class="container">
    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Dashboard') }}</div>
                    <div class="card-content">
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
