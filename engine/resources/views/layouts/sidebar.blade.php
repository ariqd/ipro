<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>

            {{--            <li class="nav-item">--}}
            {{--                <a href="{{ url('pos') }}" class="nav-link {{ (request()->is('pos*')) ? 'active' : '' }}">--}}
            {{--                    <i class="fa fa-money"></i> Point of Sales--}}
            {{--                </a>--}}
            {{--            </li>--}}

            {{--            <li class="nav-item">--}}
            {{--                <a href="{{ url('catalogues') }}"--}}
            {{--                   class="nav-link {{ (request()->is('catalogues*')) ? 'active' : '' }}">--}}
            {{--                    <i class="fa fa-th-large"></i> Catalogue--}}
            {{--                </a>--}}
            {{--            </li>--}}

            <li class="nav-item">
                <a href="{{ url('dashboard') }}"
                   class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                    <i class="fa fa-dashboard"></i> Dashboard
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
                            <a href="{{ url('vendors') }}"
                               class="nav-link {{ request()->is('vendors*') ? 'active' : '' }}">
                                <i class="fa fa-truck"></i> Vendors
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('accounts') }}"
                               class="nav-link {{ request()->is('accounts*') ? 'active' : '' }}">
                                <i class="fa fa-users"></i> Users
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="nav-item">
                <a href="{{ url('purchase-orders') }}"
                   class="nav-link {{ (request()->is('purchase-orders*')) ? 'active' : '' }}">
                    <i class="fa fa-arrow-up"></i> Purchase Order
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('goods-receive') }}"
                   class="nav-link {{ (request()->is('goods-receive*')) ? 'active' : '' }}">
                    <i class="fa fa-truck"></i> Goods Receive
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('sales-orders') }}"
                   class="nav-link {{ (request()->is('sales-orders*')) && !request()->is('sales-orders/check/approve') ? 'active' : '' }}">
                    <i class="fa fa-arrow-down"></i> Sales Order
                </a>
            </li>

            @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
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