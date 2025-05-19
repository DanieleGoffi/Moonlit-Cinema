@extends('layouts.master')

@section('title','User authentication')

@section('body')
<script>
    $(document).ready(function(){
        $("#login-form").submit(function(event) {
            // Ottenere i valori dei campi email e password
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();
            var error = false;
            // Verifica se il campo "password" è vuoto
            if (password.trim() === "") {
                error = true;
                $("#invalid-password").text("Password obbligatoria");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='password']").focus();
            } else {
                $("#invalid-password").text("");
            }

            // Verifica se il campo "email" è vuoto
            if (email.trim() === "") {
                error = true;
                $("#invalid-email").text("Email obbligatoria");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='email']").focus();
            } else {
                $("#invalid-email").text("");
            } 
        });

        $("#register-form").submit(function(event) {
            // Ottenere i valori dei campi per la registrazione
            var name = $("input[name='name']").val();
            var email = $("input[name='registration-email']").val();
            var password = $("input[name='registration-password']").val();
            // Espressione regolare per la password (almeno 8 caratteri, almeno una cifra, almeno
            // un carattere speciale tra ! - * [ ] $ & /)
            var passwordRegex = /^(?=.*[0-9])(?=.*[!\*\[\]\$&\/\.]).{8,}$/;
            var confirmPassword = $("input[name='confirm-password']").val();
            var error = false;

            // Verifica se il campo "confirm-password" è vuoto
            if (confirmPassword.trim() === "") {
                error = true;
                $("#invalid-confirmPassword").text("La re-immettere la password");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='confirm-password']").focus();
            } else {
                $("#invalid-confirmPassword").text("");
            } 

            // Verifica se il campo "password" è vuoto
            if (password.trim() === "") {
                error = true;
                $("#invalid-registrationPassword").text("Password è obbligatoria");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='registration-password']").focus();
            } else if(!passwordRegex.test(password)) {
                error = true;
                $("#invalid-registrationPassword").text("La password deve essere lunga almeno 8 caratteri, contenere almeno un numero e almeno un carettere speciale tra ! * [ ] $ &  . /");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='registration-password']").focus();
            } else {
                $("#invalid-registrationPassword").text("");
            } 

            // Verifica se il campo "email" è vuoto
            if (email.trim() === "") {
                error = true;
                $("#invalid-registrationEmail").text("Email obbligatoria");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='registration-email']").focus();
            } else {
                $("#invalid-registrationEmail").text("");
            }

            // Verifica se il campo "name" è vuoto
            if (name.trim() === "") {
                error = true;
                $("#invalid-name").text("Nome è obbligatorio");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='name']").focus();
            } else {
                $("#invalid-name").text("");
            } 

            if(!error) {
                // Verifica che la password sia state editata due volte correttamente
                if(confirmPassword.trim() !== password.trim())
                {
                    $("#invalid-confirmPassword").text("Le due password non coincidono");
                    event.preventDefault(); // Impedisce l'invio del modulo
                    $("input[name='confirm-password']").focus();
                } else {
                    $("#invalid-confirmPassword").text("");
                } 

                // effettua chiamata AJAX per verificare che l'email dell'utente non sia già presente nel DB
                event.preventDefault(); // Impedisce preventivamente l'invio del modulo prima del controllo
                $.ajax({

                    type: 'GET',

                    url: '/ajaxUser',

                    data: {email: email.trim()},

                    success: function (data) {

                        if (data.found)
                        {
                            error = true;
                            $("#invalid-registrationEmail").text("Esiste già un account registrato con questa email");
                        } else {
                            $("form")[1].submit();
                        }
                    }
                });
            }
        });
    });
</script>

        <div class="container-fluid">
            <div class="row">
                <div>
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                           <a class="nav-link active" data-bs-toggle="tab" href="#login-tab">Accedi</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-bs-toggle="tab" href="#register-tab">Sei nuovo? Registrati</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="tab-content">
                    <div class="tab-pane active" id="login-tab">
                        <form id="login-form" action="{{ route('user.login') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="email"/>
                            </div>
                            <span class="invalid-input" id="invalid-email"></span>

                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="password"/>
                            </div>
                            <span class="invalid-input" id="invalid-password"></span>

                            <!--<div class="form-group text-center mb-3">
                                <input type="checkbox" name="remember">
                                <label for="remember">Remember me</label>
                            </div>-->

                            <div class="form-group text-center mb-3">
                                <label for="login-submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Accedi </label>
                                <input id="login-submit" class="d-none" type="submit" value="Login">
                            </div>



                            <!--<div class="form-group">
                                <div class="text-center">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>-->
                        </form>
                    </div>

                    <div class="tab-pane" id="register-tab">
                        <form id="register-form" action="{{ route('user.register') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="nome utente"/>
                            </div>
                            <span class="invalid-input" id="invalid-name"></span>

                            <div class="form-group mb-3">
                                <input type="text" name="registration-email" class="form-control" placeholder="email"/>
                            </div>
                            <span class="invalid-input" id="invalid-registrationEmail"></span>

                            <div class="form-group mb-3">
                                <input type="password" name="registration-password" class="form-control" placeholder="password"/>
                            </div>
                            <span class="invalid-input" id="invalid-registrationPassword"></span>

                            <div class="form-group mb-3">
                                <input type="password" name="confirm-password" class="form-control" placeholder="conferma password"/>
                            </div>
                            <span class="invalid-input" id="invalid-confirmPassword"></span>

                            <div class="form-group text-center mb-3">
                                <label for="register-submit" class="btn btn-primary w-100"><i class="bi bi-person-plus"></i> Registrati</label>
                                <input id="register-submit" class="d-none" type="submit" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    

@endsection