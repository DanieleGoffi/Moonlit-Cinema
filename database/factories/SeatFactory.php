<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seat;
use App\Models\Screen;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    protected $model = Seat::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'row' => $this->faker->randomElement(range('A', 'Z')),
            'number' => $this->faker->numberBetween(1,30),
            'wheelchair_reserved' => $this->faker->boolean(30),
            'screen_id' => Screen::inRandomOrder()->value('id') ?? Screen::factory()
        ];
    }
}
