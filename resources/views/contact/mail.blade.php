@component('mail::message')
<h1>{{ __('This is Automatically send mail.') }}</h1>

<p>{{ $email . __('Sama') }}</p>
<p>{{ __('We have received your application, and the following are the details:') }}</p>
<p>{{ __('Depending on the contents of your inquiry, it may take a few days to reply to you.') }}</p>
<br>

<p>{{ __('Category') }} :</p>
<p>{{ $category }}</p>
<br>

<p>{{ __('Title') }} :</p>
<p>{{ $title }}</p>
<br>

<p>{{ __('Main Context') }} :</p>
<p>{!! nl2br(e($content)) !!}</p>
<br>

@lang('Regards'),<br>
{{ config('app.name') }}
@slot('footer')

@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent