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
    Carbon::setLocale('it');

    $dl = new DataLayer();
    $movies = $dl->getAvailableMovies();
    $allScreenings = [];

    foreach ($movies as $movie) {
        $screenings = $dl->getAvailableScreeningsByMovie($movie->id);

        // Raggruppa le proiezioni per giorno
        $groupedScreenings = $screenings->groupBy('projection_date');

        // Salva le proiezioni raggruppate
        $allScreenings[$movie->id] = $groupedScreenings;
    }

    return view('index', compact('movies', 'allScreenings'));
}
}
