<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
         <header class="main-header" >
            @include('layouts.navbar')
        </header>
        <v-app id="app">              
            @yield('content')
        </v-app>
        <!-- <footer class="main-footer text-dark" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2021 <a href="#">OR4</a>.</strong> All rights reserved.
        </footer> -->
    </div>
</body>
</html>

