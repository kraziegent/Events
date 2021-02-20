<?php

namespace TypiCMS\Modules\Events\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
// use TypiCMS\Modules\Events\Presenters\ModulePresenter;
use TypiCMS\Modules\History\Traits\Historable;

class EventVenue extends Base
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    // protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'venue',
        'status',
    ];

    public function isActive($locale = null): bool
    {
        $locale = $locale ?: 'en';

        return (bool) $this->translate('status', $locale);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
