<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Screening;
use App\Models\Screen;
use App\Models\Movie;
use Carbon\Carbon;

class ScreeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        if (Movie::count() == 0){
            $this->call(MovieSeeder::class);
        }

        if (Screen::count() == 0) {
            $this->call(ScreenSeeder::class);
        }

        $screenings = [
            // FILM 1 
            // giorno 1
            [
                'projection_time' => '14:30',
                'projection_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'screen_id' => 1,  
                'movie_id' => 1,   
            ],
            [
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'screen_id' => 2,
                'movie_id' => 1,
            ],
            [
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'screen_id' => 3,
                'movie_id' => 1,
            ],
            // film 1 giorno 2
            [
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'screen_id' => 2,
                'movie_id' => 1,
            ],
            [
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'screen_id' => 3,
                'movie_id' => 1,
            ],
            // film 1 giorno 3
            [
                'projection_time' => '14:30',
                'projection_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'screen_id' => 1,  
                'movie_id' => 1,   
            ],
            [
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'screen_id' => 2,
                'movie_id' => 1,
            ],
            [
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'screen_id' => 3,
                'movie_id' => 1,
            ],

             // FILM 2
             //  giorno 1
             [
                'projection_time' => '14:30',
                'projection_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'screen_id' => 4,  
                'movie_id' => 2,   
            ],
            [
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'screen_id' => 5,
                'movie_id' => 2,
            ],
            [
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'screen_id' => 6,
                'movie_id' => 2,
            ],
            // film 2 giorno 2
            [
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'screen_id' => 4,
                'movie_id' => 2,
            ],
            [
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'screen_id' => 5,
                'movie_id' => 2,
            ],
            // film 2 giorno 3
            [
                'projection_time' => '14:30',
                'projection_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'screen_id' => 4,  
                'movie_id' => 2,   
            ],
            [
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'screen_id' => 5,
                'movie_id' => 2,
            ],
            [
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'screen_id' => 6,
                'movie_id' => 2,
            ],
        ];

        // Inserisci gli screening
        foreach ($screenings as $screening) {
            Screening::create($screening);
        }
    }
}
