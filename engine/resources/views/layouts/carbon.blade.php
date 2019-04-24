<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | iPro</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('carbon/css/styles.css') }}">
    <link href="{{ asset('assets/css/ipro.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet">
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
            <img src="{{ asset('assets/img/logo.png') }}" width="80" alt="logo ipro">
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <img src="{{ asset('carbon/imgs/avatar-1.png') }}" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none"></span>
                    {{ auth()->user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item btnLogout">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                    <form class="hidden" id="formLogout" action="{{ url('logout') }}" method="post">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('dashboard') }}"
                           class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('pos') }}" class="nav-link {{ (request()->is('pos*')) ? 'active' : '' }}">
                            <i class="fa fa-money"></i> Point of Sales
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('catalogues') }}"
                           class="nav-link {{ (request()->is('catalogues*')) ? 'active' : '' }}">
                            <i class="fa fa-th-large"></i> Catalogue
                        </a>
                    </li>

                    @if(Gate::allows('isAdmin'))
                        <li class="nav-item nav-dropdown">
                            <a href="#" class="nav-link nav-dropdown-toggle">
                                <i class="fa fa-asterisk"></i> Master Data <i class="fa fa-caret-left"></i>
                            </a>

                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a href="{{ url('brands') }}"
                                       class="nav-link {{ (request()->is('brands*')) ? 'active' : '' }}">
                                        <i class="fa fa-list"></i> Brands
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('categories') }}"
                                       class="nav-link {{ (request()->is('categories*')) ? 'active' : '' }}">
                                        <i class="fa fa-list"></i> Categories
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('items') }}"
                                       class="nav-link {{ (request()->is('items*')) ? 'active' : '' }}">
                                        <i class="fa fa-list"></i> Items
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('stocks') }}"
                                       class="nav-link {{ (request()->is('stocks*')) ? 'active' : '' }}">
                                        <i class="fa fa-list"></i> Stocks
                                    </a>
                                </li>

                                @if(Gate::allows('isAdmin'))
                                    <li class="nav-item">
                                        <a href="{{ url('branches') }}"
                                           class="nav-link {{ (request()->is('branches*')) ? 'active' : '' }}">
                                            <i class="fa fa-tree"></i> iPro Branches
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('customers') }}"
                                           class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                                            <i class="fa fa-shopping-bag"></i> Customers
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#"
                                           class="nav-link {{ request()->is('pos/report*') ? 'active' : '' }}">
                                            <i class="fa fa-truck"></i> Vendors
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('accounts') }}"
                                           class="nav-link {{ request()->is('accounts*') ? 'active' : '' }}">
                                            <i class="fa fa-users"></i> Users
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ url('purchase-orders') }}"
                           class="nav-link {{ (request()->is('purchase-orders*')) ? 'active' : '' }}">
                            <i class="fa fa-arrow-up"></i> Purchase Order
                        </a>
                    </li>

                    @if(Gate::denies('isFinance'))
                        <li class="nav-item">
                            <a href="{{ url('sales-orders') }}"
                               class="nav-link {{ (request()->is('sales-orders*')) && !request()->is('sales-orders/check/approve') ? 'active' : '' }}">
                                <i class="fa fa-arrow-down"></i> Sales Order
                            </a>
                        </li>
                    @endif

                    @if(Gate::allows('isFinance') || Gate::allows("isAdmin"))
                        <li class="nav-item">
                            <a href="{{ url('sales-orders/check/approve') }}"
                               class="nav-link {{ (request()->is('sales-orders/check/approve')) ? 'active' : '' }}">
                                <i class="fa fa-arrow-down"></i> Sales Order Approve
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('finances') }}"
                               class="nav-link {{ (request()->is('finances*')) ? 'active' : '' }}">
                                <i class="fa fa-line-chart"></i> Finance
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ url('deposits') }}"
                           class="nav-link {{ (request()->is('deposits*')) ? 'active' : '' }}">
                            <i class="fa fa-credit-card"></i> Deposits
                        </a>
                    </li>
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
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">
    function updateRowOrder() {
        $('td.form_id').each(function (i) {
            $(this).text(i + 1);
        });
    }
</script>
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
