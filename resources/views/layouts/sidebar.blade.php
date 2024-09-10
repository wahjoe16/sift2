<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/user/foto/' . auth()->user()->foto) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->nama }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Menu</li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.sidang') }}" @if(Session::get('page')=='dashboardSidang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            {{-- Menu Untuk Mahasiswa --}}
            @if (auth()->user()->level == 3)
                @include('sidebar_menu.mahasiswa')
            @endif
            {{-- Akhir Menu Untuk Mahasiswa --}}
            
            @if (auth()->user()->level == 2)
                @include('sidebar_menu.dosen')
            @endif
               
            {{-- Akhir Menu untuk Dosen --}}
            
            {{-- Menu Untuk Superadmin --}}
            @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 1)
                @include('sidebar_menu.superadmin')
            @endif
            {{-- Akhir Menu untuk Superadmin --}}
            
            {{-- Menu Untuk Admin --}}
            @if (auth()->user()->level == 1)
                @include('sidebar_menu.admin')
            @endif
            {{-- Akhir Menu Untuk Admin --}}

            @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 0)
                
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Data User</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('tendikAdmin') }}" @if(Session::get('page')=='tendikAdmin' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-street-view"></i> <span>Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tendikDosen') }}" @if(Session::get('page')=='tendikDosen' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-user"></i> <span>Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tendikMahasiswa') }}" @if(Session::get('page')=='tendikMahasiswa' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-users"></i> <span>Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>