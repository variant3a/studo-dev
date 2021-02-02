<li>
    <div class="user-view">
        <div class="background">

        </div>
    </div>
    <a href="{{ route('profile') }}" class="waves-effect waves-green"><i class="material-icons left amber-text text-darken-1">person</i>{{ Auth::user()->user_id . __('San') }}</a>
</li>
<li><a href="{{ route('home') }}" class="waves-effect waves-green"><i class="material-icons left amber-text text-darken-1">home</i>{{ __('MyPage') }}</a></li>
<li><a href="{{ route('timer') }}" class="waves-effect waves-green"><i class="material-icons left amber-text text-darken-1">timer</i>{{ __('Timer') }}</a></li>
<li><a href="{{ route('notepad') }}" class="waves-effect waves-green"><i class="material-icons left amber-text text-darken-1">subject</i>{{ __('Notepad') }}</a></li>
<li><a href="{{ route('quiz') }}" class="waves-effect waves-green"><i class="material-icons left amber-text text-darken-1">rate_review</i>{{ __('Quiz') }}</a></li>
