@php
    //$notepad_usage = file_get_contents('../../notepad_usage.md');
    $markdown = new Parsedown();
    $markdown
        ->setBreaksenabled(true)
        ->setSafeMode(true)
        ->setUrlsLinked(false);
    $limit = 300;
    $end = '<br><br>...<a href="' . route('notepad_details', $note->id) . '" >' . __('Read More');
@endphp
<form action="{{ route('notepad') }}" method="POST">
    <div class="row">
        <div class="input-field col s8">
            <input type="text" id="search-word" name="keyword">
            <label for="search-word">{{ __('Keyword') }}</label>
        </div>
        <div class="input-field col s4">
            <select name="search-subject">
                <option value="" selected>{{ __('Choose Subjects') }}</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->subject_name }}">{{ __($subject->subject_name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col s12">
            <button type="submit" class="waves-effect waves-light btn right">{{ __('Search') }}</button>
        </div>
    </div>    
</form>
<div class="col s12">
    <div class="card">
        <div class="card-content" style="word-wrap: break-word">
            <div class="row">
                <div class="col s12">
                    @if ($target == 'index')
                        @if ($note->title)
                            <a href="{{ route('notepad_details', $note->id) }}" class="card-title btn-flat waves-effect waves-green waves-block tooltipped" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ $note->title }}</a>
                        @else
                            <a href="{{ route('notepad_details', $note->id) }}" class="card-title btn-flat waves-effect waves-green waves-block tooltipped grey-text" data-position="top" data-tooltip="{{ __('Details Link') }}" style="color:inherit;">{{ __('No Title') }}</a>
                        @endif
                    @else
                        @if ($note->title)
                            <div class="card-title">{{ $note->title }}</div>
                        @else
                            <div class="card-title grey-text">{{ __('No Title') }}</div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    @if ($target == 'index')
                    <div class="marked-body" style="min-height: 70vh">{!! $markdown->text($note->content) !!}</div>
                    @else
                    <div class="marked-body" style="min-height: 50vh">{!! $markdown->text($note->content) !!}</div>
                    @endif
                </div>
            </div>
            @if ($target == 'index')
                <span class="grey-text">{{ __('Subject Name') . ': ' }}</span>
                @if ($note->subject_name)
                    <span class="grey-text">{{ __($note->subject_name) }}</span>
                @else
                    <span class="grey-text">{{ __('No Selected') }}</span>
                @endif
                <a href="{{ route('notepad_details', $note->id) }}" class="grey-text right">{{ $note->updated_at->format('Y-m-d H:i') }}</a>
            @else
                <div class="row">
                    <div class="col s12">
                        <div class="grey-text">
                            @if ($note->subject_name)
                                <div>{{ __('Subject Name') . ': ' . __($note->subject_name) }}</div>
                            @else
                                <div>{{ __('Subject Name') . ': ' . __('No Selected') }}</div>
                            @endif
                            <div>{{ __('Views') . ': ' . $note->view_count . __('Times') }}</div>
                            <div>{{ __('Created At') . ': ' . $note->created_at->format('Y-m-d H:i') }}</div>
                            <div>{{ __('Updated At') . ': ' . $note->updated_at->format('Y-m-d H:i') }}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
