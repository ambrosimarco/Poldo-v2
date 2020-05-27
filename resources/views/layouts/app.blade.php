<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Al Bar Poldo') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="./images/icons/icona_bar_poldo.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./css/util.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <!--===============================================================================================-->

    <style>
        .none {
            display: none;
        }

        #lolink:hover {
            cursor: pointer;
        }

        #myBtn {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Fixed/sticky position */
            bottom: 20px;
            /* Place the button at the bottom of the page */
            right: 30px;
            /* Place the button 30px from the right */
            z-index: 99;
            /* Make sure it does not overlap */
            border: orange;
            /* Remove borders */
            outline: orange;
            /* Remove outline */
            background-color: none;
            /*Set a background color */
            cursor: pointer;
            /* Add a mouse pointer on hover */
            padding: 15px;
            /* Some padding */
            border-radius: 10px;
            /* Rounded corners */
            font-size: 18px;
            /* Increase font size */
        }

        #myBtn:hover {
            border: orange;
        }

        .parallax {
            /* The image used */
            background-image: url("https://cdn.pixabay.com/photo/2017/06/24/05/26/hot-dog-2436747_960_720.jpg");
            /* Create the parallax scrolling effect */
            height: 60em;
            width: 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
/* width */
::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
    </style>



    </style>
</head>

<!-- <body style="background: rgb(239, 222, 205)"> -->

<body>
    <div class="parallax">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <img src="./images/icons/icona_bar_poldo.png" alt="AlBarPoldo" height="50px" width="50px">
                <a class="navbar-brand ml-2" href="{{ url('/') }}">
                    {{ config('app.name', 'Al Bar Poldo') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> -->
                        @if (Route::has('register'))
                        <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li> -->
                        @endif
                        @else
                        @if (Auth::user()->role == 'class')
                        <li>
                            <a class="nav-link" href="/">Ordina</a>
                        </li>
                        @endif
                        @can('view-any', App\User::class)
                        <li>
                            <a class="nav-link" href="/users">Gestione utenti</a>
                        </li>
                        @elsecan('update', Auth::user())
                        <a class="nav-link" href="/users/{{ Auth::user()->id }}">Gestione account</a>
                        @endcan
                        @can('view-any', App\Order::class)
                        <a class="nav-link" href="/orders">Ordinazioni</a>
                        @endcan
                        @can('edit', App\Sandwich::class)
                        <a class="nav-link" href="/sandwiches">Listino</a>
                        @endcan
                        @can('view-any', App\Order::class)
                        <a class="nav-link" href="/print">Stampa liste</a>
                        @endcan
                        <li>
                            @if (Auth::user()->role == 'admin')
                            <a class="nav-link" href="/settings">Gestione Poldo</a>
                            @else
                            <a class="nav-link" href="/settings">Gestione Account</a>
                            @endif
                        </li>
                        <li>
                            <a class="nav-link" href="/contacts">Contatti</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navbar -->
 
        <!-- Container element -->
        @yield('content')
    </div>

    <footer class="footer bg-dark" style="width: 100%">
        <div class="container text-center pt-3 pb-3">
            <span class="text-white">&COPY 2020 All right reserved | Lorenzoni - Ambrosi - Du | Al Bar Poldo</span>
        </div>
        {{-- <div>
            <!-- Scroll-back button -->
            <button onclick="topFunction()" id="myBtn" title="Torna sù"><i class="fa fa-chevron-up fa-2x" style="color: orange;"></i></button>
        </div> --}}
    </footer>

</body>

</html>