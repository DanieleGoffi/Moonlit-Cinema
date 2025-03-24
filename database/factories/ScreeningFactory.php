<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Screening;
use App\Models\Screen;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screening>
 */
class ScreeningFactory extends Factory
{
    protected $model = Screening::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'projection_time' => $this->faker->time('H:i'),
            'projection_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'screen_id' => Screen::inRandomOrder()->value('id') ?? Screen::factory(),
            'movie_id' => Movie::inRandomOrder()->value('id') ?? Movie::factory(),
        ];
    }
}
