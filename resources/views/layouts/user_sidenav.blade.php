<li>
    <div class="user-view">
        <div class="background">
            
        </div>
    </div>
    <a href="{{ route('profile') }}" class="waves-effect waves-light">{{ Auth::user()->user_id . __('San') }}</a>
</li>
<li><a href="{{ route('home') }}" class="waves-effect waves-light">{{ __('MyPage') }}</a></li>
<li><a href="{{ route('timer') }}" class="waves-effect waves-light">{{ __('Timer') }}</a></li>                
<li><a href="{{ route('notepad') }}" class="waves-effect waves-light">{{ __('Notepad') }}</a></li>                
