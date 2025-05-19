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

        $i=1;
        for ($j=1; $j<=10; $j++){
            Screening::create([
                'projection_time' => '14:30',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 1,  
                'movie_id' => $i,   
            ]);
            Screening::create([
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 1,
                'movie_id' => $i,
            ]);
            Screening::create([
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 1,
                'movie_id' => $i,
            ]);
        }

        $i=2;
        for ($j=1; $j<=10; $j++){
            
            Screening::create([
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 2,
                'movie_id' => $i,
            ]);
            Screening::create([
                'projection_time' => '21:30',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 2,
                'movie_id' => $i,
            ]);
        }

        $i=3;
        for ($j=1; $j<=10; $j++){
            Screening::create([
                'projection_time' => '14:30',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 3,  
                'movie_id' => $i,   
            ]);
            Screening::create([
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 3,
                'movie_id' => $i,
            ]);
        }

        $i=4;
        for ($j=1; $j<=10; $j++){
            
            Screening::create([
                'projection_time' => '20:30',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 4,
                'movie_id' => $i,
            ]);
        }

        $i=5;
        for ($j=1; $j<=10; $j++){
            Screening::create([
                'projection_time' => '17:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 5,
                'movie_id' => $i,
            ]);
            Screening::create([
                'projection_time' => '20:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 5,
                'movie_id' => $i,
            ]);
        }

        $i=6;
        for ($j=1; $j<=10; $j++){
            Screening::create([
                'projection_time' => '15:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 6,  
                'movie_id' => $i,   
            ]);
            Screening::create([
                'projection_time' => '18:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 6,
                'movie_id' => $i,
            ]);
            Screening::create([
                'projection_time' => '22:00',
                'projection_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                'screen_id' => 6,
                'movie_id' => $i,
            ]);
        }

    }
} 