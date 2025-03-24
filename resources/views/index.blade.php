@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title') 
MoonlitCinema
@endsection

@section('active_home','active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('body')
    @foreach($movies as $movie)
    <div class="container-fluid text-center py-3">
        <div class="row">
        <h2 class="display-6 py-2"><a class = "titolo" href="{{ route('movie.show', ['movie' => $movie->id]) }}"> {{ $movie->title }} </a> </h1>
            <div class="col col-md-6 col-sm-12 text-end">
                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}"   class="img-fluid w-50">
            </div>
            <div class="col col-md-6 col-sm-12 text-start">
                <div class = "container">
                    <p><strong>Genre:</strong>
                        @foreach($movie->genres as $genre)
                            {{ $genre->name }}@if (!$loop->last), @endif
                        @endforeach
                    </p>
                    <p><strong>Director:</strong> {{$movie->director}}</p>
                    <p><strong>Cast:</strong> {{$movie->cast}}</p>
                    <p><strong>Year:</strong> {{$movie->year}}</p>
                    <p><strong>Duration:</strong> {{$movie->runtime}} minutes</p>    
                </div>
                <div class="container">
                <p><strong>Screenings:</strong></p>
                    @foreach($allScreenings[$movie->id] as $date => $screenings) <!-- Gruppo per data -->
                        <p><strong>{{ \Carbon\Carbon::parse($date)->translatedFormat('l j F') }}:</strong></p> <!-- Mostra la data formattata -->
                        <ul class="list-unstyled">
                             @foreach($screenings as $screening)
                        <a href="#" class="btn btn-primary btn-sm me-2">{{ \Carbon\Carbon::parse($screening->projection_time)->format('H:i') }}</a>
                    @endforeach
                        </ul>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    @endforeach


@endsection