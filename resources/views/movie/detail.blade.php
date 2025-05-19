@extends('layouts.master')
@section('title')
 {{ $movie -> title }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('movie.client.index') }}">Movies</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $movie -> title }}</li>
@endsection

@section('body')
<div class= "text-center py-3">

        <img src="{{ asset ('storage/'. $movie->image_url) }}" alt="{{ $movie->title }}"  class="img-fluid w-25" >
            
</div>      
<div class="container">
        <p class="fs-5">{{$movie->description}}</p></br></br>
        <p  class="fs-5"><strong>Genre:</strong>
            @foreach($movie->genres as $genre)
                {{ $genre->name }}@if (!$loop->last), @endif
            @endforeach
        </p>
        <p  class="fs-5"><strong>Director:</strong> {{$movie->director}}</p>
        <p  class="fs-5"><strong>Cast:</strong> {{$movie->cast}}</p>
        <p  class="fs-5"><strong>Year:</strong> {{$movie->year}}</p>
        <p  class="fs-5"><strong>Duration:</strong> {{$movie->runtime}} minutes</p>    
        <p  class="fs-5"><strong>Age restriction:</strong> {{$movie->age_restriction}}</p>  
</div>
            

<div class="container py-5">
    <p class="fs-4 mt-5"><i class="bi bi-calendar-event"></i> Proiezioni disponibili:</p>
    @foreach($screenings as $date => $screenings) 
    <div class="d-flex align-items-center mb-2">
        <p class="mb-2 me-3"><strong>{{ \Carbon\Carbon::parse($date)->translatedFormat('l j F') }}:</strong></p> 
        @foreach($screenings as $screening)
            <a href="#" class="btn btn-primary btn-sm me-3">{{ \Carbon\Carbon::parse($screening->projection_time)->format('H:i') }}</a>
        @endforeach
    </div>
    @endforeach

</div>
@endsection

