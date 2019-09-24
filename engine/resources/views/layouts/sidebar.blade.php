<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            @if(Gate::allows('isAdmin'))

            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a href="#" class="nav-link nav-dropdown-toggle">
                    <i class="fa fa-asterisk"></i> Master Data <i class="fa fa-caret-left"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ url('brands') }}" class="nav-link {{ (request()->is('brands*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Merek
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('categories') }}"
                            class="nav-link {{ (request()->is('categories*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('items') }}" class="nav-link {{ (request()->is('items*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('stocks') }}" class="nav-link {{ (request()->is('stocks*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Stok
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('branches') }}"
                            class="nav-link {{ (request()->is('branches*')) ? 'active' : '' }}">
                            <i class="fa fa-tree"></i> Cabang iPro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('customers') }}"
                            class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                            <i class="fa fa-shopping-bag"></i> Customers
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
            <li class="nav-item">
                <a href="{{ url('sales-orders') }}"
                    class="nav-link {{ (request()->is('sales-orders*')) && !request()->is('sales-orders/check/approve') ? 'active' : '' }}">
                    <i class="fa fa-arrow-down"></i> Sales Order
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('nota-khusus') }}"
                    class="nav-link {{ (request()->is('nota-khusus*')) && !request()->is('nota-khusus/check/approve') ? 'active' : '' }}">
                    <i class="fa fa-exclamation-circle"></i> Nota Khusus
                </a>
            </li>
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
                <a href="{{ url('finances') }}" class="nav-link {{ (request()->is('finances*')) ? 'active' : '' }}">
                    <i class="fa fa-line-chart"></i> Finance
                </a>
            </li>
            @endif

            @if (Gate::allows('isSales'))

            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('sales-orders') }}"
                    class="nav-link {{ (request()->is('sales-orders*')) && !request()->is('sales-orders/check/approve') ? 'active' : '' }}">
                    <i class="fa fa-arrow-down"></i> Sales Order
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('nota-khusus') }}"
                    class="nav-link {{ (request()->is('nota-khusus*')) && !request()->is('nota-khusus/check/approve') ? 'active' : '' }}">
                    <i class="fa fa-exclamation-circle"></i> Nota Khusus
                </a>
            </li>
            @endif

            @if(Gate::allows('isFinance'))
            <li class="nav-item">
                <a href="{{ url('sales-orders') }}"
                    class="nav-link {{ (request()->is('sales-orders*')) && !request()->is('sales-orders/check/approve') ? 'active' : '' }}">
                    <i class="fa fa-arrow-down"></i> Sales Order
                </a>
            </li>
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
                <a href="{{ url('finances') }}" class="nav-link {{ (request()->is('finances*')) ? 'active' : '' }}">
                    <i class="fa fa-line-chart"></i> Finance
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('stocks') }}" class="nav-link {{ (request()->is('stocks*')) ? 'active' : '' }}">
                    <i class="fa fa-list"></i> Stok
                </a>
            </li>   
            @endif

            @if(Gate::allows('isGudang'))
            <li class="nav-item nav-dropdown">
                <a href="#" class="nav-link nav-dropdown-toggle">
                    <i class="fa fa-asterisk"></i> Master Data <i class="fa fa-caret-left"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ url('brands') }}" class="nav-link {{ (request()->is('brands*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Merek
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('categories') }}"
                            class="nav-link {{ (request()->is('categories*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('items') }}" class="nav-link {{ (request()->is('items*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('stocks') }}" class="nav-link {{ (request()->is('stocks*')) ? 'active' : '' }}">
                            <i class="fa fa-list"></i> Stok
                        </a>
                    </li>
                </ul>
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
            @endif
        </ul>
    </nav>
</div>