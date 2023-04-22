<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Caja Cusco @yield('titulo')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/icons/logo-cc.ico') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/css-hamburgers/hamburgers.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	
</head>
<body>

    <header class="header">
        <div class="container-logo">
            <a href="#" class="logo">
                <img src="{{ asset('img/logo-cc.png') }}" class="logo" alt="">
            </a>
        </div>
    </header>
    <!-- <div class="container-login100"> -->
    <div class="container-login100">
        @yield('contenido')
    </div>
    
    <script src="{{ asset('libraries/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('libraries/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('libraries/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fontawsome.min.js') }}" crossorigin="anonymous"></script>
    @yield('script-js')
</body>
</html>