<?php

namespace Database\Factories\Events;

use TypiCMS\Modules\Events\Models\Event;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Events\Models\EventContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    use HasTranslations;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = ['coordinator', 'facilitator'];

        return [
            'type' => $this->setTranslations('type', ['en' => $this->faker->randomElement($type)]),
            'details' => $this->faker->boolean ? 1 : 0,
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->mobileNumber(),
            'description' => $this->setTranslations('description', ['en' => $this->faker->paragraphs()]),
            'event_id' => Event::factory(),
        ];
    }

    // function(array $product) {
    //         return factory(\App\Store::class)->create(['user_id' => $product['user_id']])->id;
    //     }
}
