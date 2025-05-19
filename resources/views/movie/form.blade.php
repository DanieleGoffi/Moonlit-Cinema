@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title')
@if(isset($movie->id))
    Modifica Film
@else
    Aggiungi un Film
@endif
@endsection


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
@if(isset($movie->id))
    <li class="breadcrumb-item active" aria-current="page">Edit movie</li>
@else
    <li class="breadcrumb-item active" aria-current="page">Add movie</li>
@endif
@endsection

@section('body')

<script>
$(document).ready(function () {
    $("form").submit(function (event) {
        let error = false;

        let title = $("input[name='title']").val().trim();
        let year = $("input[name='year']").val().trim();
        let description = $("textarea[name='description']").val().trim();
        let director = $("input[name='director']").val().trim();
        let genres = $("select[name='genres[]'] option:selected");
        let fileInput = $("input[name='image']")[0];
        let imageProvided = fileInput.files.length > 0;

        // Titolo
        if (title === "") {
            error = true;
            $("#invalid-title").text("Il titolo del film è obbligatorio.");
        } else {
            $("#invalid-title").text("");
        }

        // Anno
        if (year === "") {
            error = true;
            $("#invalid-year").text("L'anno del film è obbligatorio.");
        } else if (parseInt(year) < 1800) {
            error = true;
            $("#invalid-year").text("L'anno deve essere successivo al 1800.");
        } else {
            $("#invalid-year").text("");
        }

    
        

        // Descrizione
        if (description === "") {
            error = true;
            $("#invalid-description").text("La descrizione del film è obbligatoria.");
        } else {
            $("#invalid-description").text("");
        }

        // Regista
        if (director === "") {
            error = true;
            $("#invalid-director").text("Il regista del film è obbligatorio.");
        } else {
            $("#invalid-director").text("");
        }

        // Generi
        if (genres.length === 0) {
            error = true;
            $("#invalid-genres").text("Selezionare almeno un genere.");
        } else {
            $("#invalid-genres").text("");
        }

        // Controllo immagine (solo in creazione)
        @if(!(isset($movie->id) && $movie->image_url))
            if (!imageProvided) {
                error = true;
                $("#invalid-image").text("È obbligatorio selezionare un'immagine.");
            }
        @endif

        if (imageProvided) {
            let file = fileInput.files[0];
            let allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            if (!allowedTypes.includes(file.type)) {
                error = true;
                $("#invalid-image").text("Il file deve essere un'immagine JPEG, PNG o GIF.");
            } else if (file.size > 2 * 1024 * 1024) {
                error = true;
                $("#invalid-image").text("L'immagine non può superare i 2MB.");
            } else {
                $("#invalid-image").text("");
            }
        }

        // Se c'è errore, blocca subito
        if (error) {
            event.preventDefault();
            return;
        }

        // Se siamo in creazione, verifica AJAX per titolo duplicato
        let metodoHttp = $('input[name="_method"]').val();
        if (metodoHttp === undefined) {
            event.preventDefault();
            $.ajax({
                type: 'GET',
                url: '/ajaxMovie',
                data: { title: title },
                success: function (data) {
                    if (data.found) {
                        $("#invalid-title").text("Un film con questo titolo esiste già nel database.");
                    } else {
                        $("form")[0].submit();
                    }
                }
            });
        }
    });
});
</script>




<div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
        @if(isset($movie->id))
            <h4><i class="bi bi-film"></i> Modifica Film</h4>
        @else
            <h4><i class="bi bi-film"></i> Aggiungi un Nuovo Film</h4>
        @endif
        </div>
        <div class="card-body">
        @if(isset($movie->id))
            <form name="movie" method="post" action="{{ route('movie.update',['movie' => $movie->id]) }}"  enctype="multipart/form-data">
            @method('PUT')
        @else
            <form name="movie" method="post" action="{{ route('movie.store') }}"  enctype="multipart/form-data">
        @endif
            @csrf
                <div class="form-floating mb-3">
                @if(isset($movie->id))
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titolo" value="{{ $movie->title }}">
                @else
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titolo">
                @endif
                    <label for="title"><i class="bi bi-type"></i> Titolo</label>
                    <small class="text-danger" id="invalid-title"></small>
                </div>

                <div class="form-floating mb-3">
                @if(isset($movie->id))
                    <input type="number" class="form-control" name="year" id="year" placeholder="Anno" value="{{ $movie->year }}">
                @else
                    <input type="number" class="form-control" name="year" id="year" placeholder="Anno">
                @endif
                    <label for="year"><i class="bi bi-calendar"></i> Anno</label>
                    <small class="text-danger" id="invalid-year"></small>
                </div>

                <!-- Durata -->
                <div class="form-floating mb-3">
                @if(isset($movie->id))
                    <input type="number" class="form-control" name="runtime" id="runtime" placeholder="Durata" value="{{ $movie->runtime }}">
                @else
                    <input type="number" class="form-control" name="runtime" id="runtime" placeholder="Durata">
                @endif
                    <label for="runtime"><i class="bi bi-clock"></i> Durata (minuti)</label>
                    <small class="text-danger" id="invalid-runtime"></small>
                </div>

                <!---
                <div class="form-floating mb-3"> 
                @if(isset($movie->id))
                    <input type="file" class="form-control" name="image" id="image" value="{{ asset ('storage/'. $movie->image_url) }}">    
                @else
                    <input type="file" class="form-control" name="image" id="image">
                @endif
                <label for="image_url"><i class="bi bi-image"></i> Immagine</label>
                <small class="text-danger" id="invalid-image"></small">
                </div>--->

                {{-- Mostra immagine attuale (fuori dal blocco floating) --}}
                <label for="image" class="form-label text-muted"><i class="bi bi-image"></i> Immagine</label>
                @if(isset($movie->id) && $movie->image_url)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $movie->image_url) }}" alt="Locandina" width="200" class="img-thumbnail">
                    </div>
                @endif

                {{-- Campo immagine con floating label --}}
                <div class="mb-3">
                    <input type="file" class="form-control" name="image" id="image">
                    <small class="text-danger" id="invalid-image"></small>
                </div>




                <div class="form-floating mb-3">
                @if(isset($movie->id))
                    <input type="text" class="form-control" name="director" id="director" placeholder="Regista" value="{{ $movie->director }}">
                @else
                    <input type="text" class="form-control" name="director" id="director" placeholder="Regista">
                @endif
                    <label for="director"><i class="bi bi-person-video2"></i> Regista</label>
                    <small class="text-danger" id="invalid-director"></small>
                </div>

                <div class="form-floating mb-3">
                @if(isset($movie->id))
                    <input type="text" class="form-control" name="cast" id="cast" placeholder="Cast" value="{{ $movie->cast }}">
                @else
                    <input type="text" class="form-control" name="cast" id="cast" placeholder="Cast">
                @endif
                    <label for="cast"><i class="bi bi-people"></i> Cast</label>
                    <small class="text-danger" id="invalid-cast"></small>
                </div>

                <!-- Età Minima -->
                <div class="form-floating mb-3">
                    <select class="form-select" name="age_restriction" id="age_restriction">
                        <option selected disabled>Seleziona restrizione età</option>
                        @if(isset($movie->id))
                            <option value="G" {{ $movie->age_restriction === "G" ? "selected" : "" }}>G</option>
                            <option value="PG" {{ $movie->age_restriction === "PG" ? "selected" : "" }}>PG</option>
                            <option value="PG-13" {{ $movie->age_restriction === "PG-13" ? "selected" : "" }}>PG-13</option>
                            <option value="R" {{ $movie->age_restriction === "R" ? "selected" : "" }}>R</option>
                            <option value="NC-17" {{ $movie->age_restriction === "NC-17" ? "selected" : "" }}>NC-17</option>
                        @else
                            <option value="G">G</option>
                            <option value="PG">PG</option>
                            <option value="PG-13">PG-13</option>
                            <option value="R">R</option>
                            <option value="NC-17">NC-17</option>
                        @endif
                    </select>
                    <label for="age_restriction"><i class="bi bi-exclamation-triangle"></i> Età Minima</label>
                    <small class="text-danger" id="invalid-age"></small>
                </div>

                <div class="form-floating mb-3">
                @if(isset($movie->id))
                    <textarea class="form-control" name="description" id="description" placeholder="Descrizione" style="height: 120px;">{{ $movie->description }}</textarea>
                @else
                    <textarea class="form-control" name="description" id="description" placeholder="Descrizione" style="height: 120px;"></textarea>
                @endif
                    <label for="description"><i class="bi bi-align-start"></i> Descrizione</label>
                    <small class="text-danger" id="invalid-description"></small>
                </div>
                <!-- Generi -->
                <div class="form-floating mb-3">
                    <select class="form-select" multiple style="height: 160px"  name="genres[]" id="genres">
                        @foreach ($genres as $genre)
                            @if(isset($movie->id) && $movie->genres->contains($genre->id))
                                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                            @else
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="genres"><i class="bi bi-tags"></i> Generi</label>
                    <small class="text-danger" id="invalid-genres"></small>
                </div>

                

                <!-- Pulsanti -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Salva </button>
                    <a href="{{ route('movie.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle"></i> Annulla</a>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection