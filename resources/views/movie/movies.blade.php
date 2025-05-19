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
    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset ('storage/'. $movie->image_url) }}" class="card-img-top img-fluid" alt="{{ $movie->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><a class = "titolo" href="{{ route('movie.client.show', ['movie' => $movie->id]) }}"> {{ $movie->title }} </a></h5>
                        <p class="card-text"><strong>Regista:</strong> {{ $movie->director }}</p>
                        <p class="card-text"><strong>Cast:</strong> {{ $movie->cast }}</p>
                        <p class="card-text"><strong>Anno:</strong> {{ $movie->year }}</p>
                        <p class="card-text"><strong>Genere:</strong> @foreach($movie->genres as $genre)
                                                                        {{ $genre->name }}@if (!$loop->last), @endif
                                                                        @endforeach</p>
                        <p class="card-text"><strong>Durata:</strong> {{ $movie->runtime }} minuti</p>
                        <p><strong>Limite età:</strong> {{$movie->age_restriction}}</p>    
                        <p class="card-text text-muted">{{ Str::limit($movie->description, 120, '...') }}</p>
                        
                        <!-- Piccola sezione proiezioni (opzionale) -->
                        @if($movie->screenings->isNotEmpty()) <!-- SOLO SE SONO FUTURE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                            <p class="text-muted small mt-auto">
                                <i class="bi bi-calendar-event"></i> Proiezioni disponibili
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<div>
   
</div>
@endsection

