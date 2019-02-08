<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Ipro') }}</title>--}}
    <title>Ipro</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/ipro.css') }}" rel="stylesheet">

    <style>
        #app {
            background: url({{ asset('assets').'/img/bg.png' }}) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            position: fixed;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex align-items-center">
        <main class="w-100">
            @yield('content')
        </main>
    </div>
</body>
@stack("js")
</html>
