@extends('layouts.app')

@section('content')
    <div class="col s12 xl10 offset-xl1">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <div class="center-align">
                            @if (Auth::user()->name !== null)
                                <h2>{{ Auth::user()->name }}</h2>
                            @else
                            <h2>{{ Auth::user()->user_id }}</h2>
                            @endif
                            <div>{{ '@' . Auth::user()->user_id }}</div>
                        </div>    
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス1
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス2
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス3
                    </div>
                    <div class="col s12 l6 center-align">
                        ステータス4
                    </div>
                    <div class="col s6 l4 center-align">
                        ステータス5
                    </div>
                    <div class="col s12 l6 center-align">
                        ステータス6
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection