<?php

namespace TypiCMS\Modules\Events\Composers;

use Illuminate\View\View;
use TypiCMS\Modules\Events\Models\EventVenue;

class SelectVenuesComposer
{
    /**
     * The supported event venues.
     */
    protected $venues;

    /**
     * Create a new select venues composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->venues = EventVenue::all();
    }

    /**
     * Bind venues to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->venues->filter(function ($value, $key) {
            return $value->isActive();
        });



        $view->with('venues', $this->venues->pluck('venue', 'id'));
    }
}
