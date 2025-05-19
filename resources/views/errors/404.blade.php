<!DOCTYPE html>
<html data-bs-theme="dark">
    <head>
        <title>authentication error</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">

        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet">

        <!-- jQuery e plugin JavaScript
        <script src="http://code.jquery.com/jquery.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>

        <!-- Custom jQuery and Javascript scripts -->
        <script src="{{ url('/') }}/js/paginationScript.js"></script>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        
       

        
    <div class="container-fluid bg-body-tertiary">
        <header class="text-center font-monospace">
            <h1 class="display-6 text-danger">
            404
            </h1>
        </header>
    </div>

        <div class="container-fluid text-center py-2">
            <p class="fs-3">{{ $message }}</p>
        </div>
    </body>

    <div class="text-center py-1">
    <img src="{{ asset('imgs/err.png') }}" class="rounded" alt="errore" width="300" height="300">
    </div>

    <div class="container-fluid text-center">
        <p class="fs-6">Torna alla <a href="{{ route('home') }}">home</a></p>
    </div>

    

    



    <footer class="bg-primary-gradient">
        <div class="container py-4 py-lg-5">
            
            <div class="row">
                <div class="col-12 col-lg-4">
                    <h5>Dove trovarci:</h5>
                    <p>Via delle rose, 13 </p>
                    <p>25032 Chiari BS</p>
                    <p>Italia</p>   
        </div>
    </footer>

</html>