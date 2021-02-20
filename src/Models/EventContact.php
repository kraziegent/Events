<?php

namespace TypiCMS\Modules\Events\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
// use TypiCMS\Modules\Events\Presenters\ModulePresenter;
use TypiCMS\Modules\History\Traits\Historable;

class EventContact extends Base
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    // protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'type',
        'description',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
