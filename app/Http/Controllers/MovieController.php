<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     public function index()
     {
         $dl = new DataLayer();
         $movies = $dl->getMovies();
         
         return view('movie.index')->with('movies', $movies);
     }
     */

     public function index(Request $request)
    {
        $dl = new DataLayer();

        if ($request->has('search') && !empty($request->search)) {
            $movies = $dl->findMovieByTitle($request->search);
        }
        else {
            $movies = $dl->getMovies();
        }

        return view('movie.index')->with('movies', $movies);
    }



    public function indexClient()
    {
        session_start();
        if (isset($_SESSION['logged']) && $_SESSION['role'] == 'admin') {
            return response()->view('errors.404', ['message' => 'Accesso non autorizzato per gli amministratori!'], 404);
        }
        
        $dl = new DataLayer();
        $movies = $dl->getMovies();
        
        return view('movie.movies')->with('movies', $movies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dl = new DataLayer();
        $genres = $dl->getGenres();

        return view('movie.form')->with('genres', $genres);
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genres = $request->input('genres', []);

        $dl = new DataLayer();

        $image_path = $request->file('image')->store('imgs', 'public');

        
        $dl->addMovie($request->input('title'), $request->input('year'), $request->input('runtime'), $request->input('description'), $image_path, $request->input('director'), $request->input('age_restriction'), $request->input('cast'), $genres);

        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    public function showClient (string $id)
    {
        session_start();
        $dl = new DataLayer();
        $movie = $dl->findMovieById($id);

        $screenings = $dl->getFutureScreeningsByMovie($id);
        $screenings = $screenings->groupBy('projection_date');

        if ($movie == null){
            return response()->view('errors.404', ['message' => 'Film non esistente!'], 404);
        } else {
            return view('movie.detail')->with('movie', $movie)->with('screenings', $screenings);
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $movie = $dl->findMovieById($id);
        $genres = $dl->getGenres();

        if ($movie == null){
            return response()->view('errors.404', ['message' => 'Film non esistente!'], 404);
        } else {
            return view('movie.form')->with('movie', $movie)->with('genres', $genres);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dl = new DataLayer();

        $image_path = $request->file('image')->store('imgs', 'public');

        $dl->updateMovie($id, $request->input('title'), $request->input('year'), $request->input('runtime'), $request->input('description'), $image_path, $request->input('director'), $request->input('age_restriction'), $request->input('cast'));

        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ajaxCheckMovie(Request $request)
{
    $dl = new DataLayer();
    
    // Verifica se il film con il titolo esatto esiste nel database
    $found = $dl->checkMovieByExactTitle($request->input('title'));

    // Restituisci la risposta in formato JSON
    return response()->json(['found' => $found]);
}


    
}
