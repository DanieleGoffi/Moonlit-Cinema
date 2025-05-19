<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seat;
use App\Models\Screening;
use App\Models\User;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seat_id' => Seat::inRandomOrder()->value('id') ?? Seat::factory(),
            'screening_id' => Screening::inRandomOrder()->value('id') ?? Screening::factory(),
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()
        ];
    }
}
