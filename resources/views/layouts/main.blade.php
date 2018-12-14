<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - iPro</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/ipro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/font-awesome/css/font-awesome.min.css">

    @stack('css')
    @stack('style')

</head>
<body>
<div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/logo.png') }}" width="55" alt="logo ipro">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <div class="navbar-nav ml-auto">
                <li class="nav-item dropleft">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Welcome, Admin
                        {{--Welcome, {{ Auth::user()->name }}--}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{--<a class="dropdown-item" href="#">Action</a>--}}
                        {{--<a class="dropdown-item" href="#">Another action</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        <a class="dropdown-item btnLogout" href="{{ url('logout') }}">Logout</a>
                        <form class="hidden" id="formLogout" action="{{ url('logout') }}" method="post">
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom">
        {{--<a class="navbar-brand" href="#">Navbar</a>--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ (Request::is('/')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item {{ (Request::is('dashboard*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item {{ (Request::is('pos*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/pos') }}">Point of Sales</a>
                </li>
                <li class="nav-item {{ (Request::is('catalogues*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/catalogues') }}">Catalogue</a>
                </li>
                <li class="nav-item {{ (Request::is('inventories*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/inventories') }}">Inventory</a>
                </li>
                <li class="nav-item {{ (Request::is('finances*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/finances') }}">Finance</a>
                </li>
                <li class="nav-item {{ (Request::is('accounts*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/accounts') }}">User Account</a>
                </li>
                <li class="nav-item {{ (Request::is('deposits*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/deposits') }}">Deposits</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="mt-4 main">
        @yield('content')
    </main>

    <footer class="footer mt-5 text-light py-3">
        <div class="text-center">
            Indoteknik Pratama Pro <br>
            Jl. Jendral Sudirman No. 672B Bandung <br>
            Telp. 022-20573322 <br>
        </div>
    </footer>
</div>

<script src="{{ asset('assets') }}/plugins/jquery/jquery-3.1.0.min.js"></script>
{{--<script--}}
{{--src="https://code.jquery.com/jquery-2.2.4.min.js"--}}
{{--integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="--}}
{{--crossorigin="anonymous"></script>--}}
<script src="{{ asset('assets') }}/js/vendors/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets') }}/js/core.js"></script>
<script src="{{ asset('assets') }}/plugins/select2/select2.full.min.js"></script>
<script src="{{ asset('assets') }}/plugins/sweetalert/sweetalert.min.js"></script>
@stack('js')
@stack('script')
<script>
    $(document).ready(function () {
        $('.btnLogout').on('click', function (e) {
            e.preventDefault();

            $('#formLogout').submit();
        })
    });
</script>
</body>
</html>
