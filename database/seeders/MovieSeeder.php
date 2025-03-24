<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assicuriamoci che i generi esistano
        if (Genre::count() == 0) {
            $this->call(GenreSeeder::class);
        }

        $movies = [
            [
                'title' => 'L’Ultimo dei Mohicani',
                'year' => 1992,
                'runtime' => 112,
                'description' => 'Gli ultimi membri una tribù di nativi americani, Uncas, il padre Chingachgook ed il fratello adottivo Occhio di falco, vivono in pace accanto ad un gruppo di colonizzatori britannici. In seguito al rapimento delle figlie di un colonnello inglese per mano di un esploratore, i due giovani sono costretti a prendere parte alla sanguinosa guerra fra i francesi e gli indiani.',
                'image_url' => 'imgs/mohicans.jpg',
                'director' => 'Michael Mann',
                'age_restriction' => 'R',
                'genres' => ['Adventure', 'Drama', 'Historical'],
                'cast' => 'Daniel Day-Lewis, Madeleine Stowe, Russell Means'
            ],
            [
                'title' => "L'Impero colpisce ancora",
                'year' => 1980,
                'runtime' => 124,
                'description' => 'Il maestro Yoda prepara il giovane Luke Skywalker ad affrontare il terribile tiranno Dart Fener, il quale è in procinto di lanciare un devastante attacco per schiacciare i ribelli.',
                'image_url' => 'imgs/swV.jpg',
                'director' => 'Irvin Kershner',
                'age_restriction' => 'PG',
                'genres' => ['Science Fiction', 'Adventure', 'Fantasy'],
                'cast' => 'Mark Hamill, Harrison Ford, Carrie Fisher'
            ]
        ];

        // Inserimento manuale dei film e associazione ai generi
        foreach ($movies as $movieData) {
            $movie = Movie::create([
                'title' => $movieData['title'],
                'year' => $movieData['year'],
                'runtime' => $movieData['runtime'],
                'description' => $movieData['description'],
                'image_url' => $movieData['image_url'],
                'director' => $movieData['director'],
                'age_restriction' => $movieData['age_restriction'],
                'cast' => $movieData['cast']
            ]);

            // Associa i generi ai film
            $genreIds = Genre::whereIn('name', $movieData['genres'])->pluck('id');
            $movie->genres()->attach($genreIds);
        }



    }
}
