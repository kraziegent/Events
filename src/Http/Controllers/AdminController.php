<?php

namespace TypiCMS\Modules\Events\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Events\Exports\Export;
use TypiCMS\Modules\Events\Http\Requests\FormRequest;
use TypiCMS\Modules\Events\Models\Event;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('events::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' events.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Event();

        return view('events::admin.create')
            ->with(compact('model'));
    }

    public function edit(Event $event): View
    {
        return view('events::admin.edit')
            ->with(['model' => $event]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $event = Event::create($this->format($data));

        return $this->redirect($request, $event);
    }

    public function update(Event $event, FormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $event->update($this->format($data));

        return $this->redirect($request, $event);
    }

    protected function format(Array $data): Array
    {
        $start_date = $data['start_date'].' '.$data['start_time'];
        $end_date = $data['start_date'].' '.$data['end_time'];

        unset($data['start_time']);
        unset($data['end_time']);

        if(is_string($data['occurence'])) {
            $data['occurence'] = json_encode(array('frquency' => 'once', 'interval' => '1'));
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        return $data;
    }
}
