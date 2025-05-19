<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\DataLayer;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function getHome()
{
    session_start();
    Carbon::setLocale('it');

    $dl = new DataLayer();
    $movies = $dl->getWeekMovies();
    $allScreenings = [];

    foreach ($movies as $movie) {
        $screenings = $dl->getWeekScreeningsByMovie($movie->id);

        // Raggruppa le proiezioni per giorno
        $groupedScreenings = $screenings->groupBy('projection_date');

        // Salva le proiezioni raggruppate
        $allScreenings[$movie->id] = $groupedScreenings;
    }

    return view('index', compact('movies', 'allScreenings'));
}

    public function getHome1()
{
    session_start();
    Carbon::setLocale('it');

    $dl = new DataLayer();
    $screenings = $dl->getWeekScreenings();

    $movies = $screenings->pluck('movie')->unique('id')->values()->all();

    $screeningsByMovie = $allScreenings
        ->groupBy(fn($s) => $s->movie->id)         
        ->map(fn($group) => 
            $group->groupBy('projection_date')    
        );

    return view('index', compact('movies', 'screeningsByMovie'));
   
}

}
