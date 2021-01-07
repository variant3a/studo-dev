@php
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
                <div class="col s12">
                    @if ($target == 'index')
                        <a href="#my-post-dropdown" class="dropdown-trigger waves-effect waves-light btn-flat right" data-target="my-post-dropdown{{ $note->id }}"><i class="material-icons">more_vert</i></a>
                        <ul id='my-post-dropdown{{ $note->id }}' class='dropdown-content'>
                            <li><a href="#delete-my-note{{ $note->id }}" class="waves-effect waves-red red-text modal-trigger"><i class="material-icons left">delete</i>{{ __('Delete') }}</a>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('delete_note', $note->id) }}">
                            @method('DELETE')
                            @csrf
                            <div id="delete-my-note{{ $note->id }}" class="modal">
                                <div class="modal-content">
                                    <h4>{{ __('Attention!') }}</h4>
                                    <p>{{ __('Are you sure you want to delete this note?') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="modal-close waves-effect waves-light btn-flat">{{ __('Cancel') }}</a>
                                    <button type="submit" class="waves-effect waves-light btn red">{{ __('Delete') }}</button>
                                </div>
                            </div>
                        </form>
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
                    <div class="markdown-body" style="min-height: 40vh">{!! $markdown->text($note->content) !!}</div>
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
