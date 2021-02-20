<?php

namespace TypiCMS\Modules\Events\Models;

use Database\Factories\Events\EventFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Events\Presenters\ModulePresenter;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;

class Event extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;
    use HasFactory;

    protected $presenter = ModulePresenter::class;

    protected $dates = ['start_date', 'end_date'];

    protected $guarded = [];

    public $translatable = [
        'title',
        'slug',
        'status',
        'venue',
        'address',
        'summary',
        'body',
        'website',
        'paid',
        'public',
        'restriction',
        'occurence',
        'resources',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return EventFactory::new();
    }

    public function upcoming($number = null): Collection
    {
        $query = $this->published()
            ->where('end_date', '>=', date('Y-m-d'))
            ->orderBy('start_date');
        if ($number) {
            $query->take($number);
        }

        return $query->get();
    }

    public function past($number = null): Collection
    {
        $query = $this->published()
            ->where('end_date', '<', date('Y-m-d'))
            ->order();
        if ($number) {
            $query->take($number);
        }

        return $query->get();
    }

    public function adjacent($direction, $model, $category_id = null, array $with = [], $all = false): ?Model
    {
        $currentModel = $model;
        if ($currentModel->end_date < date('Y-m-d')) {
            $models = $this->past();
        } else {
            $models = $this->upcoming();
        }
        foreach ($models as $key => $model) {
            if ($currentModel->id === $model->id) {
                $adjacentKey = $key + $direction;

                return isset($models[$adjacentKey]) ? $models[$adjacentKey] : null;
            }
        }
    }

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(EventSeries::class, 'series_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(EventTicket::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(EventContact::class);
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(EventAttendee::class);
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(EventVenue::class);
    }
}
