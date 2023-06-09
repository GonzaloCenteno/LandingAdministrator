<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/icons/logo-cc.ico') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<style>
        .fontawesomeSelect {
            font-family: 'FontAwesome'
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            
                        @else
                        <li class="nav-item">
                            <a href="{{ route('landing.index') }}" class="nav-link text-muted h5" href="#">Landing</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('formulario.index') }}" class="nav-link text-muted h5" href="#">Formulario</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departamento.index') }}" class="nav-link text-muted h5" href="#">Departamentos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('distrito.index') }}" class="nav-link text-muted h5" href="#">Distritos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link text-muted h5" href="#" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Cerrar Sesion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('contenido')
        </main>
    </div>
    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/fontawsome.min.js') }}" crossorigin="anonymous"></script>
    @yield('script-js')
</body>
</html>
