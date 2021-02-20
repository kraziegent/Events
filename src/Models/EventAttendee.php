<?php

namespace TypiCMS\Modules\Events\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
// use TypiCMS\Modules\Events\Presenters\ModulePresenter;
use TypiCMS\Modules\History\Traits\Historable;

class EventAttendee extends Base
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    // protected $presenter = ModulePresenter::class;

    protected $dates = ['checked_in_at'];

    protected $guarded = [];

    public $translatable = [
        'payment_status',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(EventTicket::class);
    }
}
