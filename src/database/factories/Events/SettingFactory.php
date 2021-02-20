<?php

namespace Database\Factories\Events;

use Carbon\Carbon;
use Illuminate\Support\Str;
use TypiCMS\Modules\Events\Models\Event;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;


class SettingFactory extends Factory
{
    use HasTranslations;

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
        $paid = [1, "0"];
        $visibility = ['public', 'private'];
        $restriction = ['members', 'non members'];
        $occurence = json_encode(['interval' => '1', 'frequency' => 'weekly']);

        return [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $this->setTranslations('status', ['en' => 1]),
            'title' => $this->setTranslations('title', ['en' => $title]),
            'slug' => $this->setTranslations('slug', ['en' => $slug]),
            'venue' => $this->setTranslations('paid', ['en' => $this->faker->randomElement($venues)]),
            'summary' => $this->setTranslations('paid', ['en' => $this->faker->paragraph()]),
            'body' => $this->setTranslations('paid', ['en' => $this->faker->paragraphs()]),
            'paid' => $this->setTranslations('paid', ['en' => $this->faker->randomElement($paid)]),
            'visibility' => $this->setTranslations('visibility', ['en' => $this->faker->randomElement($visibility)]),
            'restriction' => $this->setTranslations('restriction', ['en' => $this->faker->randomElement($restriction)]),
            'occurence' => $this->setTranslations('occurence', ['en' => $this->faker->randomElement($occurence)]),
        ];
    }
}
