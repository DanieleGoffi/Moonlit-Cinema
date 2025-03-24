<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Genre;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(3), // Titolo casuale
            'year' => $this->faker->numberBetween(1945, 2025), // Anno tra 1980 e 2025
            'runtime' => $this->faker->numberBetween(80, 180), // Durata tra 80 e 180 min
            'description' => $this->faker->paragraph(3), // Breve descrizione
            'image_url' => $this->faker->imageUrl(300, 450, 'movies', true), // URL immagine casuale
            'director' => $this->faker->name(), // Nome del regista
            'age_restriction' => $this->faker->randomElement(['G', 'PG', 'PG-13', 'R', 'NC-17']), // Classificazione età
            'cast' => $this->faker->name() . ', ' . $this->faker->name() . ', ' . $this->faker->name() // Cast
        ];
        }

    public function configure()
        {
            return $this->afterCreating(function (Movie $movie) {
                $genres = Genre::inRandomOrder()->limit(rand(1, 3))->pluck('id'); // 1-3 generi casuali
                $movie->genres()->attach($genres);
            });
        }
}
