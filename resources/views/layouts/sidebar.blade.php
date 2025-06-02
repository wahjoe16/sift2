<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo"><h2 style="color: white;">FakultasTeknik</h2></a>
            {{-- <a href="{{ route('dashboard') }}" class="logo"><img src="{{ url('/kai/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20"/></a> --}}
            {{-- <h3 class="text-white">FakultasTeknik</h3> --}}
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="badge badge-secondary"></span>
                    </a>
                </li>

                {{-- Menu Super Admin --}}
                @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 1)
                    @include('sidebar_menu.superadmin')
                @endif

                {{-- Menu Untuk Admin --}}
                @if (auth()->user()->level == 1)
                    @include('sidebar_menu.admin')
                @endif

                @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 0)

                    <li class="nav-item {{ Route::is('tendikDosen') || Route::is('dashboardDosen.show') 
                                        || Route::is('tendikAdmin') || Route::is('tendikMahasiswa')
                                        || Route::is('dashboardMahasiswa.show') ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#users-admin">
                            <i class="fas fa-user"></i>
                            <p>Data User</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ Route::is('tendikDosen') || Route::is('dashboardDosen.show')
                                             || Route::is('tendikAdmin') || Route::is('dashboardMahasiswa.show')
                                             || Route::is('tendikMahasiswa') ? 'show' : '' }}" id="users-admin">
                            <ul class="nav nav-collapse">
                                <li class="{{ Route::is('tendikDosen') || Route::is('dashboardDosen.show') ? 'active' : '' }}">
                                    <a href="{{ route('tendikDosen') }}">
                                        <span class="sub-item">Dosen</span>
                                    </a>
                                </li>
                                <li class="{{ Route::is('tendikAdmin') ? 'active' : '' }}">
                                    <a href="{{ route('tendikAdmin') }}">
                                        <span class="sub-item">Admin</span>
                                    </a>
                                </li>
                                <li class="{{ Route::is('tendikMahasiswa') || Route::is('dashboardMahasiswa.show') ? 'active' : '' }}">
                                    <a href="{{ route('tendikMahasiswa') }}">
                                        <span class="sub-item">Mahasiswa</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endif

                {{-- Menu Untuk Mahasiswa --}}
                @if (auth()->user()->level == 3)
                    @include('sidebar_menu.mahasiswa')
                @endif
                
                {{-- Menu Untuk Dosen --}}
                @if (auth()->user()->level == 2)
                    @include('sidebar_menu.dosen')
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->