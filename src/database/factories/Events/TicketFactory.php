<?php

namespace Database\Factories\Events;

use TypiCMS\Modules\Events\Models\EventTicket;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;
use TypiCMS\Modules\Events\Models\EventContact;

class TicketFactory extends Factory
{
    use HasTranslations;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = ['free', 'paid'];
        $price = $type === 'free' ? 0 : $this->faker->randomNumber(2, true);
        $vat = [0, $price * 0.2];
        $restriction = ['members', 'non members'];
        $contact = EventContact::factory();

        return [
            'type' => $this->setTranslations('type', ['en' => $type]),
            'title' => $this->setTranslations('title', ['en' => $this->faker->sentence()]),
            'currency' => 'GBP',
            'price' => $price,
            'vat' => $vat,
            'max' => $this->faker->randomDigitNotNull(),
            'restriction' => $this->setTranslations('restriction', ['en' => $this->faker->randomElement($restriction)]),
            'event_id' => $contact->event_id,
        ];
    }
}
