@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Dashboard') }}</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
