<?php

namespace TypiCMS\Modules\Events\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Events\Models\Event;
use TypiCMS\Modules\Events\Repositories\EloquentEvent;

class ApiController extends BaseApiController
{
    public function __construct(EloquentEvent $event)
    {
        parent::__construct($event);
    }

    public function index(Request $request)
    {
        $models = QueryBuilder::for(Event::class)
            ->allowedFilters('start_date')
            ->translated(['title', 'status'])
            ->with('files')
            ->paginate($request->input('per_page'));

        return $models;
    }

    protected function update(Event $event, Request $request)
    {
        $data = [];
        foreach ($request->all() as $column => $content) {
            if (is_array($content)) {
                foreach ($content as $key => $value) {
                    $data[$column.'->'.$key] = $value;
                }
            } else {
                $data[$column] = $content;
            }
        }

        foreach ($data as $key => $value) {
            $event->$key = $value;
        }
        $saved = $event->save();

        $this->repository->forgetCache();

        return response()->json([
            'error' => !$saved,
        ]);
    }

    public function destroy(Event $event)
    {
        $deleted = $this->repository->delete($event);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
