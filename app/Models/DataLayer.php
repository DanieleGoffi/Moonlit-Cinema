<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class DataLayer extends Model
{
    // FRONT

    public function getWeekScreenings(){
        $screenings = Screening::whereHas('movie')
            ->where(function($query) {
                $query->whereBetween('projection_date', [Carbon::now()->toDateString(), Carbon::now()->addDays(7)->toDateString()])
                      ->whereDate('projection_date', '>', Carbon::now()->toDateString());
            })
            ->orWhere(function($query) {
                $query->whereDate('projection_date', Carbon::now()->toDateString())
                      ->whereTime('projection_time', '>', Carbon::now()->toTimeString());
            })
            ->get();
    
        return $screenings;
    }

    public function getWeekMovies_() {
        $movies = Movie::with(['screenings' => function($query) {
            $query->where(function($query) {
                $query->whereBetween('projection_date', [Carbon::now()->toDateString(), Carbon::now()->addDays(7)->toDateString()])
                      ->whereDate('projection_date', '>', Carbon::now()->toDateString());
            })
            ->orWhere(function($query) {
                $query->whereDate('projection_date', Carbon::now()->toDateString())
                      ->whereTime('projection_time', '>', Carbon::now()->toTimeString());
            });
        }])->get();
    
        return $movies;
    }

    public function getWeekMovies() {
    $today = Carbon::now()->toDateString();
    $nowTime = Carbon::now()->toTimeString();
    $in7Days = Carbon::now()->addDays(7)->toDateString();

    $movies = Movie::whereHas('screenings', function($query) use ($today, $in7Days, $nowTime) {
        $query->where(function($query) use ($today, $in7Days) {
            $query->whereBetween('projection_date', [$today, $in7Days])
                  ->whereDate('projection_date', '>', $today);
        })->orWhere(function($query) use ($today, $nowTime) {
            $query->whereDate('projection_date', $today)
                  ->whereTime('projection_time', '>', $nowTime);
        });
    })
    ->get();

    return $movies;
}


    public function getWeekScreeningsByMovie($movie_id) {
        $screenings = Screening::where(function($query) use ($movie_id) {
            $query->where('movie_id', $movie_id)
                  ->whereBetween('projection_date', [Carbon::now()->toDateString(), Carbon::now()->addDays(7)->toDateString()])
                  ->whereDate('projection_date', '>', Carbon::now()->toDateString());
        })
        ->orWhere(function($query) use ($movie_id) {
            $query->where('movie_id', $movie_id)
                  ->whereDate('projection_date', Carbon::now()->toDateString())
                  ->whereTime('projection_time', '>', Carbon::now()->toTimeString());
        })
        ->get();
    
        return $screenings;
    }



    public function getFutureScreeningsByMovie($movie_id) {
        $screenings = Screening::where(function($query) use ($movie_id) {
            $query->where('movie_id', $movie_id)
                  ->whereDate('projection_date', '>', Carbon::now()->toDateString());
        })
        ->orWhere(function($query) use ($movie_id) {
            $query->where('movie_id', $movie_id)
                  ->whereDate('projection_date', Carbon::now()->toDateString())
                  ->whereTime('projection_time', '>', Carbon::now()->toTimeString());
        })
        ->get();
    
        return $screenings;
    }



    // MOVIES
    public function findMovieById($id) {
        return Movie::find($id);
    }

    public function getMovies() {

        return Movie::all();
    }

    public function findMovieByTitle($title) {
        // Rimuovi gli spazi prima e dopo il titolo
        $title = trim($title);
    
        // Esegui la query con collation case-insensitive
        return Movie::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($title) . '%'])->get();
    }

    public function checkMovieByExactTitle($title) {
        // Rimuovi gli spazi prima e dopo il titolo
        $title = trim($title);
        
        // Esegui una query per trovare il film con il titolo esatto, case insensitive
        return Movie::whereRaw('LOWER(title) = ?', [strtolower($title)])->exists();
    }
    

    public function addMovie($title, $year, $runtime, $description, $image_url, $director, $age_restriction, $cast, $genres) {
        $movie = new Movie();
        $movie->title = $title;
        $movie->year = $year;
        $movie->runtime = $runtime;
        $movie->description = $description;
        $movie->image_url = $image_url;
        $movie->director = $director;
        $movie->age_restriction = $age_restriction;
        $movie->cast = $cast;
        $movie->save();
        foreach ($genres as $genre) {
            $movie->genres()->attach($genre);
        }
    }

    public function updateMovie($id, $title, $year, $runtime, $description, $image_url, $director, $age_restriction, $cast) {
        $movie = Movie::find($id);
        if ($movie) {
            $movie->title = $title;
            $movie->year = $year;
            $movie->runtime = $runtime;
            $movie->description = $description;
            $movie->image_url = $image_url;
            $movie->director = $director;
            $movie->age_restriction = $age_restriction;
            $movie->cast = $cast;
            $movie->save();
        }
    }
    public function deleteMovie($id) {
        $movie = Movie::find($id);
        if ($movie) {
            $movie->delete();
        }
    }

    // GENRES
    public function getGenres() {
        return Genre::all();
    }
        

    // SCREENS
    public function getAllScreens() {
        return Screen::all();
    }


    // AUTHENTICATION
    public function validUser($email, $password) {
        $user = User::where('email', $email)->first();
        
        if($user && Hash::check($password, $user->password))
        {
            return true;
        } else {
            return false;
        }        
    }
    
    public function addUser($name, $password, $email) {
        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->role = "client";
        $user->email_verified_at = now();
        $user->save();
    }

    public function getUserID($email) {
        $users = User::where('email',$email)->get(['id']);
        return $users[0]->id;
    }

    public function getUserName($email) {
        $users = User::where('email',$email)->get(['name']);
        return $users[0]->name;
    }

    public function getUserRole($email) {
        $users = User::where('email',$email)->get(['role']);
        return $users[0]->role;
    }

    public function findUserByemail($email) {
        $users = User::where('email', $email)->get();
        
        if (count($users) == 0) {
            return false;
        } else {
            return true;
        }
    }
}

