<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Screen;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screen>
 */
class ScreenFactory extends Factory
{
    protected $model = Screen::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1, 10), // Numero dello schermo (da 1 a 10)
            'technology' => $this->faker->randomElement(['IMAX', '3D', 'Standard']), // Tecnologia dello schermo
        ];
    }
}
