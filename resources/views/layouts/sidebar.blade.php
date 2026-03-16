<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">
                        {{ auth()->user()->name }}
                    </span>
                    <span class="text-secondary text-small">
                        {{ auth()->user()->email }}
                    </span>
                </div>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('kategori') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kategori') }}">
                <span class="menu-title">Kategori</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('buku') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buku') }}">
                <span class="menu-title">Buku</span>
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('pdf.sertifikat') }}">
                <span class="menu-title">Generate Sertifikat</span>
                <i class="mdi mdi-file-pdf-box menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('pdf.undangan') }}">
                <span class="menu-title">Generate Undangan</span>
                <i class="mdi mdi-file-document menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('barang.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <span class="menu-title">Barang</span>
                <i class="mdi mdi-cube-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'table.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('table.index') }}">
                <span class="menu-title">Barang (HTML Table)</span>
                <i class="mdi mdi-table menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'datatables.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('datatables.index') }}">
                <span class="menu-title">Barang (DataTables)</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('select-kota') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('select-kota') }}">
                <span class="menu-title">Kota</span>
                <i class="mdi mdi-map-marker menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('wilayah-ajax') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('wilayah-ajax') }}">
                <span class="menu-title">Wilayah (AJAX)</span>
                <i class="mdi mdi-map menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('wilayah-axios') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('wilayah-axios') }}">
                <span class="menu-title">Wilayah (Axios)</span>
                <i class="mdi mdi-map-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('transaksi-ajax') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksi-ajax') }}">
                <span class="menu-title">Transaksi (AJAX)</span>
                <i class="mdi mdi-cash-register menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('transaksi-axios') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksi-axios') }}">
                <span class="menu-title">Transaksi (Axios)</span>
                <i class="mdi mdi-credit-card-outline menu-icon"></i>
            </a>
        </li>
        
    </ul>
</nav>