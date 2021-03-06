<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bem vindo!</title>

        <!-- Fonts -->

        <link rel="stylesheet" href="vendor/adminlte/dist/css/adminlte.css">
        <link rel="stylesheet" href="vendor/fontawesome-free/css/all.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #F2F2F2;
                color: #2E2E2E;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                    <h5><a class="btn btn-dark" title="Login" href="{{ route('login') }}">
                      <i class="fas fa-sign-in-alt"></i> Login</a></h5>

                        <!--
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                      -->
                    @endauth
                </div>
            @endif

            <div class="content">
              <div class="display-2">
                  FAC Anchieta
              </div>
              <img src="storage/sac.png" class="img" style="width: 40%;" alt="Imagem responsiva">


                <div class="links">
                    <p>Vers??o 1.0</p>
                </div>
            </div>
        </div>
    </body>
</html>
