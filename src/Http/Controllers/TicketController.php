<?php

namespace TypiCMS\Modules\Events\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use TypiCMS\Modules\Events\Models\Event;
use TypiCMS\Modules\Events\Models\EventTicket;
use Illuminate\Pagination\LengthAwarePaginator;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class TicketController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(EventTicket::class)
            ->selectFields($request->input('fields.events'))
            ->allowedSorts(['status_translated', 'start_date', 'end_date', 'title_translated'])
            ->allowedFilters([AllowedFilter::scope('by_event'),])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function store(Request $request, Event $event)
    {
        $ticket = new EventTicket($request);

        $event->tickets()->save($ticket);

    }

    public function update(Request $request, EventTicket $ticket)
    {
        $ticket->update($request);
    }

    public function destroy(EventTicket $ticket)
    {
        $ticket->delete();
    }
}
