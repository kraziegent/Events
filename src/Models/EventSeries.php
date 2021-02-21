<?php

namespace TypiCMS\Modules\Events\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
// use TypiCMS\Modules\Events\Presenters\ModulePresenter;
use TypiCMS\Modules\History\Traits\Historable;

class EventSeries extends Base
{
    use Historable;
    use PresentableTrait;

    // protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
