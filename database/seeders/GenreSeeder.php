<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genre_names = [
            'Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 
            'Documentary', 'Drama', 'Fantasy', 'Historical', 'Horror', 
            'Musical', 'Mystery', 'Romance', 'Science Fiction', 'Thriller', 'Western'
        ];

        foreach ($genre_names as $genre_name) {
            Genre::factory()->create(['name' => $genre_name]);
        }
    }
}
