<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Admin') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? 'Administrator' }}</a>
                <small class="text-muted">{{ Auth::user()->role ?? 'Admin' }}</small>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Master -->
                <li class="nav-header">DATA MASTER</li>
                
                <!-- Warga -->
                <li class="nav-item {{ request()->routeIs('warga.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Warga
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('warga.index') }}" class="nav-link {{ request()->routeIs('warga.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('warga.create') }}" class="nav-link {{ request()->routeIs('warga.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Warga</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Perangkat Desa -->
                <li class="nav-item {{ request()->routeIs('perangkat_desa.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('perangkat_desa.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Perangkat Desa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('perangkat_desa.index') }}" class="nav-link {{ request()->routeIs('perangkat_desa.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Perangkat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('perangkat_desa.create') }}" class="nav-link {{ request()->routeIs('perangkat_desa.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Perangkat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Jabatan -->
                <li class="nav-item {{ request()->routeIs('jabatan.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('jabatan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Jabatan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->routeIs('jabatan.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jabatan.create') }}" class="nav-link {{ request()->routeIs('jabatan.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Jabatan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Laporan -->
                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <!-- Pengaturan -->
                <li class="nav-header">PENGATURAN</li>
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>