<?php

namespace Database\Factories\Events;

use Carbon\Carbon;
use Illuminate\Support\Str;
use TypiCMS\Modules\Events\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;


class EventFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear())->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($start_date)->addDays($this->faker->randomNumber(3))->format('Y-m-d H:i:s');
        $venues = ['physical location', 'zoom', 'teams', 'meet'];
        $title = $this->faker->sentence();
        $slug = Str::slug($title);
        $paid = ["1", "0"];
        $restriction = ['members', 'non members'];
        $occurence = json_encode(['interval' => '1', 'frequency' => 'weekly']);

        return [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 1,
            'title' => $title,
            'slug' => $slug,
            'venue' => $this->faker->randomElement($venues),
            'summary' => $this->faker->paragraph(),
            'body' => $this->faker->paragraphs(),
            'paid' => $this->faker->randomElement($paid),
            'public' => $this->faker->randomElement($paid),
            'restriction' => $this->faker->randomElement($restriction),
            'occurence' => 'once',
        ];
    }
}
