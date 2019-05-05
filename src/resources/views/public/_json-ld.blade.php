<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Event",
    "location": {
        "@type": "Place",
        "name": "{{ $event->venue }}",
        "address": "{{ $event->address }}"
    },
    "name": "{{ $event->title }}",
    "startDate": "{{ $event->start_date->format('c') }}",
    "endDate": "{{ $event->end_date->format('c') }}",
    "description": "{{ $event->summary !== '' ? $event->summary : strip_tags($event->body) }}",
    "image": [
        "{{ $event->present()->image() }}"
    ],
    @if ($event->url !== null)
    "url": "{{ $event->url }}",
    @endif
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $event->uri() }}"
    }
}
</script>
