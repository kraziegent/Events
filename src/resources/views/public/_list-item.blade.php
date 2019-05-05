@include('events::public._json-ld')
<li class="event-list-item">
    <a class="event-list-item-link" href="{{ $event->uri() }}">
        <div class="event-list-item-image-wrapper">
            <img class="event-list-item-image" src="{!! $event->present()->image(540, 400) !!}" alt="">
        </div>
        <div class="event-list-item-info">
            <div class="event-list-item-date">{!! $event->present()->dateFromTo !!}</div>
            <div class="event-list-item-title">{{ $event->title }}</div>
            <div class="event-list-item-location">
                <span class="event-list-item-venue">{{ $event->venue }}</span>
                <div class="event-list-item-address">{!! nl2br($event->address) !!}</div>
            </div>
            @if ($event->summary !== null)
            <div class="event-list-item-summary">{{ $event->summary }}</div>
            @endif
            @if ($event->url !== null)
            <div class="event-list-item-url"><a href="{{ $event->url }}" target="_blank" rel="noopener noreferrer">{{ parse_url($event->url, PHP_URL_HOST) }}</a></div>
            @endif
        </div>
    </a>
</li>
