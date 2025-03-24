<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DataLayer extends Model
{
    // FRONT
    public function getAvailableMovies(){
        $movies = Movie::with(['screenings' => function($query) {
            // Filtra le proiezioni future
            $query->whereDate('projection_date', '>', Carbon::now()->toDateString())
                  ->orWhere(function($query) {
                      // Se la proiezione è per oggi, filtra anche per l'orario
                      $query->whereDate('projection_date', Carbon::now()->toDateString())
                            ->whereTime('projection_time', '>', Carbon::now()->toTimeString());
                  });
        }])->get();

        return $movies;
    }

    public function getAvailableScreeningsByMovie($movie_id){
        $screenings = Screening::where('movie_id', $movie_id)
                               ->whereDate('projection_date', '>', Carbon::now()->toDateString())
                               ->orWhere(function($query) {
                                   // Se la proiezione è per oggi, filtra anche per l'orario
                                   $query->whereDate('projection_date', Carbon::now()->toDateString())
                                         ->whereTime('projection_time', '>', Carbon::now()->toTimeString());
                               })
                               ->get();

        return $screenings;
    }

    // MOVIES
    public function findMovieById($id) {
        return Movie::find($id);
    }
}

