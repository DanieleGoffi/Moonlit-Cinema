<!DOCTYPE html>
<html data-bs-theme="dark">
    <head>
        <title>@yield('title')</title>
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

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                        <a class="nav-link  @yield('active_home') fs-2 font-monospace" aria-current="page" href="{{ route('home') }}"> <img src="{{ asset('imgs/moon.svg') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                        MoonlitCinema</a>
                        <a class="nav-link fs-2 font-monospace" href="#">Movies</a>
                        <a class="nav-link fs-2 font-monospace" href="#">Tickets</a>
                        <a class="nav-link disabled fs-2 font-monospace" aria-disabled="true">Disabled</a>
                        </div>
                </div>
            </div>
        </nav>


        <div class="container-fluid d-flex">
            <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" 
            aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
        
        <div class="container-fluid">
            <header class="header-sezione text-center">
                <h1 class="font-monospace">
                    @yield('title')
                </h1>
            </header>
        </div>


        <div class="container-fluid">
            @yield('body')
        </div>
    </body>




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