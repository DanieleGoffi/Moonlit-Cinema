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
                'title' => "L'Ultimo dei Mohicani",
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
            ],
            [
                'title' => "The VVitch",
                'year' => 2015,
                'runtime' => 92,
                'description' => 'Nel 1630, una famiglia di coloni puritani viene esiliata da una comunità religiosa e costretta a trasferirsi in una radura ai margini di un bosco. Ben presto, la famiglia inizia a subire una serie di eventi inquietanti e misteriosi.',
                'image_url' => 'imgs/witch.jpg',
                'director' => 'Robert Eggers',
                'age_restriction' => 'R',
                'genres' => ['Horror', 'Mystery'],
                'cast' => 'Anya Taylor-Joy, Ralph Ineson, Kate Dickie'
            ],
            [
                'title' => "The Hateful Eight",
                'year' => 2015,
                'runtime' => 168,
                'description' => 'Durante una tempesta di neve, un cacciatore di taglie, un prigioniero, un generale confederato e una donna misteriosa si rifugiano in un saloon. Ben presto, i quattro individui si rendono conto che non tutti sono chi dicono di essere.',
                'image_url' => 'imgs/hateful.jpg',
                'director' => 'Quentin Tarantino',
                'age_restriction' => 'R',
                'genres' => ['Western', 'Mystery'],
                'cast' => 'Samuel L. Jackson, Kurt Russell, Jennifer Jason Leigh'
            ],
            [
                'title' => "La città incantata",
                'year' => 2001,
                'runtime' => 125,   
                'description' => 'Chihiro è una bambina di dieci anni molto capricciosa e viziata e quando i suoi genitori le dicono che devono trasferirsi, ovviamente reagisce in modo irritante, arrabbiandosi. Durante il viaggio per raggiungere la nuova casa, i tre si fermano in una città fantasma governata da una strega malvagia con al suo seguito antiche divinità e creature magiche.',
                'image_url' => 'imgs/spirited.jpg',
                'director' => 'Hayao Miyazaki',
                'age_restriction' => 'PG',
                'genres' => ['Animation', 'Adventure', 'Fantasy'],
                'cast' => 'Rumi Hiiragi, Miyu Irino, Mari Natsuki'
            ],
            [
                'title' => "Il Signore degli Anelli: La Compagnia dell'Anello",
                'year' => 2001,
                'runtime' => 178,
                'description' => 'Un giovane hobbit e un variegato gruppo, composto da umani, un nano, un elfo e altri hobbit, partono per un delicata missione, guidati dal potente mago Gandalf. Devono distruggere un anello magico e sconfiggere così il malvagio Sauron.',
                'image_url' => 'imgs/lotr1.jpg',
                'director' => 'Peter Jackson',
                'age_restriction' => 'PG-13',
                'genres' => ['Fantasy', 'Adventure'],
                'cast' => 'Elijah Wood, Ian McKellen, Orlando Bloom, Viggo Mortensen'
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
