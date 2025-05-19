@extends('layouts.master')
@section('title')
 Movies
@endsection

@section('active_screens','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Sale</a></li>
@endsection

@section('body')



<div class="container mt-4">
    <div class="row ">
            @foreach($screens as $screen)   
                <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                        <h5 class="card-text"><strong>Numero:</strong> {{ $screen->number }}</p>
                        <p class="card-text"><strong>Tipo:</strong> {{ $screen->technology }}</p>   
                        <p class="card-text"><strong>Capienza:</strong> {{ count($screen->seats) }}</p>
                </div>
                <div class="d-flex">
                        <!-- Bottone Modifica -->
                        <a href="#" class="btn btn-warning btn-sm me-2">Modifica</a>
                        <!-- Bottone Elimina -->
                        <a href="#" class="btn btn-danger btn-sm me-2" onclick="event.preventDefault(); if(confirm('Sei sicuro di voler eliminare questa sala?')) { document.getElementById('delete-form-{{ $screen->id }}').submit(); }">Elimina</a>
                </div>
                </div>
            @endforeach
    </div>
</div>



@endsection

