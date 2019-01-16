<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | iPro</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    {{--<link rel="stylesheet" href="{{ asset('carbon/vendor/simple-line-icons/css/simple-line-icons.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('carbon/vendor/font-awesome/css/fontawesome-all.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('carbon/css/styles.css') }}">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/ipro.css') }}" rel="stylesheet">
    @stack('css')
    @stack('style')
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    <nav class="navbar page-header">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="#">
            {{--<img src="./imgs/logo.png" alt="logo">--}}
            <img src="{{ asset('assets/img/logo.png') }}" width="80" alt="logo ipro">
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <ul class="navbar-nav ml-auto">
            {{--<li class="nav-item d-md-down-none">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-bell"></i>--}}
            {{--<span class="badge badge-pill badge-danger">5</span>--}}
            {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item d-md-down-none">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-envelope-open"></i>--}}
            {{--<span class="badge badge-pill badge-danger">5</span>--}}
            {{--</a>--}}
            {{--</li>--}}

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    {{--<img src="./imgs/avatar-1.png" class="avatar avatar-sm" alt="logo">--}}
                    <img src="{{ asset('carbon/imgs/avatar-1.png') }}" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    {{--<div class="dropdown-header">Account</div>--}}

                    {{--<a href="#" class="dropdown-item">--}}
                    {{--<i class="fa fa-user"></i> Profile--}}
                    {{--</a>--}}

                    {{--<a href="#" class="dropdown-item">--}}
                    {{--<i class="fa fa-envelope"></i> Messages--}}
                    {{--</a>--}}

                    {{--<div class="dropdown-header">Settings</div>--}}

                    {{--<a href="#" class="dropdown-item">--}}
                    {{--<i class="fa fa-bell"></i> Notifications--}}
                    {{--</a>--}}

                    {{--<a href="#" class="dropdown-item">--}}
                    {{--<i class="fa fa-wrench"></i> Settings--}}
                    {{--</a>--}}

                    <a href="#" class="dropdown-item btnLogout">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                    <form class="hidden" id="formLogout" action="{{ url('logout') }}" method="post">
                        {!! csrf_field() !!}
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    {{--<li class="nav-title">Navigation</li>--}}

                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ (Request::is('/')) ? 'active' : '' }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('dashboard') }}"
                           class="nav-link {{ (Request::is('dashboard*')) ? 'active' : '' }}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('pos') }}" class="nav-link {{ (Request::is('pos*')) ? 'active' : '' }}">
                            <i class="fa fa-money"></i> Point of Sales
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('catalogues') }}"
                           class="nav-link {{ (Request::is('catalogues*')) ? 'active' : '' }}">
                            <i class="fa fa-th-large"></i> Catalogue
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('inventories') }}"
                           class="nav-link {{ (Request::is('inventories*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Inventory
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('purchase-orders') }}"
                           class="nav-link {{ (Request::is('purchase-orders*')) ? 'active' : '' }}">
                            <i class="fa fa-arrow-up"></i> Purchase Order
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('sales-orders') }}"
                           class="nav-link {{ (Request::is('sales-orders*')) ? 'active' : '' }}">
                            <i class="fa fa-arrow-down"></i> Sales Order
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('finances') }}"
                           class="nav-link {{ (Request::is('finances*')) ? 'active' : '' }}">
                            <i class="fa fa-line-chart"></i> Finance
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('accounts') }}"
                           class="nav-link {{ (Request::is('accounts*')) ? 'active' : '' }}">
                            <i class="fa fa-users"></i> User Accounts
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('deposits') }}"
                           class="nav-link {{ (Request::is('deposits*')) ? 'active' : '' }}">
                            <i class="fa fa-credit-card"></i> Deposits
                        </a>
                    </li>

                    {{--<li class="nav-item nav-dropdown">--}}
                    {{--<a href="#" class="nav-link nav-dropdown-toggle">--}}
                    {{--<i class="icon icon-target"></i> Layouts <i class="fa fa-caret-left"></i>--}}
                    {{--</a>--}}

                    {{--<ul class="nav-dropdown-items">--}}
                    {{--<li class="nav-item">--}}
                    {{--<a href="layouts-normal.html" class="nav-link">--}}
                    {{--<i class="icon icon-target"></i> Normal--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="layouts-fixed-sidebar.html" class="nav-link">--}}
                    {{--<i class="icon icon-target"></i> Fixed Sidebar--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="layouts-fixed-header.html" class="nav-link">--}}
                    {{--<i class="icon icon-target"></i> Fixed Header--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="layouts-hidden-sidebar.html" class="nav-link">--}}
                    {{--<i class="icon icon-target"></i> Hidden Sidebar--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="forms.html" class="nav-link">--}}
                    {{--<i class="icon icon-puzzle"></i> Forms--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-title">More</li>--}}

                    {{--<li class="nav-item nav-dropdown">--}}
                    {{--<a href="#" class="nav-link nav-dropdown-toggle">--}}
                    {{--<i class="icon icon-umbrella"></i> Pages <i class="fa fa-caret-left"></i>--}}
                    {{--</a>--}}

                    {{--<ul class="nav-dropdown-items">--}}
                    {{--<li class="nav-item">--}}
                    {{--<a href="blank.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> Blank Page--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="login.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> Login--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="register.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> Register--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="invoice.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> Invoice--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="404.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> 404--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="500.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> 500--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                    {{--<a href="settings.html" class="nav-link">--}}
                    {{--<i class="icon icon-umbrella"></i> Settings--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </nav>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('carbon/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('carbon/vendor/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('carbon/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('carbon/vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('carbon/js/carbon.js') }}"></script>
<script src="{{ asset('carbon/js/demo.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
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
