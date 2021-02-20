<?php

namespace Database\Factories\Events;

use Carbon\Carbon;
use Illuminate\Support\Str;
use TypiCMS\Modules\Events\Models\EventAttendee;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;
use TypiCMS\Modules\Events\Models\EventTicket;

class AttendeeFactory extends Factory
{
    use HasTranslations;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventAttendee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $checked_in_at = $this->faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear())->format('Y-m-d H:i:s');
        $ticket = EventTicket::factory();
        $amount = $ticket->type === 'free' ? 0 : $this->faker->randomNumber(2, true);
        $payment_status = $ticket->type === 'free' ? 'not required' : 'unpaid';

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'checked_in_at' => $checked_in_at,
            'event_id' => $ticket->event_id,
            'ticket_id' => $ticket->id,
            // 'payment_id' => $payment->id,
            'payment_status' => $this->setTranslations('payment_status', ['en' => $payment_status]),
            'amount' => $amount,
        ];
    }
}
