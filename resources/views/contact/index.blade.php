@extends('layouts.app')

@section('title', __('Contact Us'))

@section('app-title', __('Contact Us'))

@section('content')
<form method="POST" action="{{ route('contact_submit') }}">
@csrf
    <div class="col s12 xl10 offset-xl1">
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{ __('Contact Us') }}</div>
                <div class="row">
                    <div class="col s12">
                        &nbsp;
                        <p>{{ __('Please fill in the required items and press "Submit" button.') }}</p>
                        &nbsp;
                        <p>{{ __('For user and post reports, it may be auto-filled.') . __('In that case, please add the reason to the text and send it.') }}</p>
                        <p>{{ __('If it is not auto-filled, please send us the username, URL and reason to report.') }}</p>
                        &nbsp;
                        <p>{{ __('Depending on the contents of your inquiry, it may take a few days to reply to you.') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <select name="category">
                            <option value="" selected disabled>{{ __('No Selected') }}</option>
                            <option value="{{ __('About Services') }}" @if (old('category') == __('About Services')) selected @endif>{{ __('About Services') }}</option>
                            <option value="{{ __('About Sites') }}" @if (old('category') == __('About Sites')) selected @endif>{{ __('About Sites') }}</option>
                            <option value="{{ __('Report Bugs, Typos') }}" @if (old('category') == __('Report Bugs, Typos')) selected @endif>{{ __('Report Bugs, Typos') }}</option>
                            <option value="{{ __('Report Users') }}" @if (old('category') == __('Report Users')) selected @endif>{{ __('Report Users') }}</option>
                            <option value="{{ __('Report Posts') }}" @if (old('category') == __('Report Posts')) selected @endif>{{ __('Report Posts') }}</option>
                            <option value="{{ __('Other') }}" @if (old('category') == __('Other')) selected @endif>{{ __('Other') }}</option>
                        </select>
                        <label>{{ __('Choose Category') }}</label>
                    </div>
                    <div class="input-field col s12">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="input-field col s12">
                        <input id="contact-title" type="text" class="validate" name="title" value="{{ old('title') }}" data-length="50" autocomplete="off" required>
                        <label for="contact-title">{{ __('Title') }}</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="contact-content" type="text" class="materialize-textarea validate" name="content" style="overflow:auto; min-height: 20vh; max-height: 50vh" data-length="500" autocomplete="off" required>{{ old('content') }}</textarea>
                        <label for="contact-content">{{ __('Main Context') }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection