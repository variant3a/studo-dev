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

<div class="col s12">
    <div class="card">
        <div class="card-content" style="word-wrap: break-word">
            <div class="row">
                @if ($target == 'index')
                    @if ($note->title)
                        <a href="{{ route('notepad_details', $note->id) }}" class="card-title waves-effect waves-block" style="color:inherit;">{{ $note->title }}</a>
                    @else
                        <a href="{{ route('notepad_details', $note->id) }}" class="card-title waves-effect waves-block grey-text" style="color:inherit;">{{ __('No Title') }}</a>
                    @endif
                @else
                    @if ($note->title)
                        <div class="card-title">{{ $note->title }}</div>
                    @else
                        <div class="card-title grey-text">{{ __('No Title') }}</div>
                    @endif
                @endif
            </div>
            <div class="row">
                @if ($target == 'index')
                <div class="marked-body">{!! Str::limit($markdown->text($note->content), $limit, $end) !!}</div>
                @else
                <div class="marked-body">{!! $markdown->text($note->content) !!}</div>
                @endif
            </div>
            @if ($target == 'index')
            <div class="grey-text right">{{ $note->updated_at->format('Y-m-d H:i') }}</div>
            @else
            <div class="row">
                <div class="grey-text">
                    <div>{{ __('Views') . ': ' . $note->view_count . __('Times') }}</div>
                    <div>{{ __('Created At') . ': ' . $note->created_at->format('Y-m-d H:i') }}</div>
                    <div>{{ __('Updated At') . ': ' . $note->updated_at->format('Y-m-d H:i') }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>    
</div>
