@extends('layouts.master')
@section('title')
 Movies
@endsection

@section('active_movies','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Movies</a></li>
@endsection

@section('body')
<div class="container mt-4">
    <!-- Form di ricerca -->
    <form action="{{ route('movie.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cerca un film per titolo..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cerca</button>
        </div>
    </form>

    <div class="row">
        @foreach($movies as $movie)
            <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <!-- Immagine -->
                    <img src="{{ asset ('storage/'. $movie->image_url) }}" class="img-thumbnail me-3" alt="{{ $movie->title }}" style="width: 50px; height: auto;">
                    <!-- Dettagli del film -->
                    <div>
                        <h5 class="mb-1">{{ $movie->title }}</h5>
                        <p class="mb-1"><strong>Regista:</strong> {{ $movie->director }}</p>
                        <p class="mb-1"><strong>Anno:</strong> {{ $movie->year }}</p>
                        <p class="mb-1"><strong>Genere:</strong>
                            @foreach($movie->genres as $genre)
                                {{ $genre->name }}@if (!$loop->last), @endif
                            @endforeach
                    </div>
                </div>
                <div class="d-flex">
                    <!-- Bottone Modifica -->
                     <a href="{{ route('movie.edit', ['movie' => $movie->id]) }}" class="btn btn-warning btn-sm me-2">Modifica</a>
                    <!-- Bottone Elimina -->
                    <a href="#" class="btn btn-danger btn-sm me-2" onclick="event.preventDefault(); if(confirm('Sei sicuro di voler eliminare questo film?')) { document.getElementById('delete-form-{{ $movie->id }}').submit(); }">Elimina</a>
                    
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bottone per aggiungere un film -->
    <div class="text-center mt-4 py-5">
        <a href="{{ route('movie.create') }}" class="btn btn-success btn-lg">Aggiungi Film</a>
</div>




<div>
   
</div>
@endsection

