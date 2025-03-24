<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Genre;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    protected $model = Genre::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $genre_names = [
                        'Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 
                        'Documentary', 'Drama', 'Fantasy', 'Historical', 'Horror', 
                        'Musical', 'Mystery', 'Romance', 'Science Fiction', 'Thriller', 'Western'
                    ];

        return [
            'name' => $this->faker->randomElement($genre_names),
        ];
    }
}
