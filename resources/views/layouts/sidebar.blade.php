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
                <a href="{{ url('/dashboard') }}">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
            @if (auth()->user()->level == 1)
            <li class="header">Data Master</li>
            <li>
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-street-view"></i> <span>Admin</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.index') }}">
                    <i class="fa fa-user"></i> <span>Dosen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.index') }}">
                    <i class="fa fa-users"></i> <span>Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tahunajaran.index') }}">
                    <i class="fa fa-hourglass"></i> <span>Tahun Ajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('semester.index') }}">
                    <i class="fa fa-hourglass-end"></i> <span>Semester</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Pertambangan')
            <li>
                <a href="{{ route('seminar_tmb.index') }}">
                    <i class="fa fa-upload"></i> <span>Kolokium Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sidang_tmb.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Sidang Skripsi</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Industri')
            <li>
                <a href="{{ route('seminar_ti.index') }}">
                    <i class="fa fa-upload"></i> <span>Seminar Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sidang_ti.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Sidang Tugas Akhir</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
            <li>
                <a href="{{ route('seminar_pwk.index') }}">
                    <i class="fa fa-upload"></i> <span>Sidang Pembahasan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sidang_pwk.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Sidang Terbuka</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_koordinator_skripsi == 1)
            <li class="header">Kolokium Skripsi</li>
            <li>
                <a href="{{ route('view-seminarTmb.index') }}">
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-seminarTmb.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            <li class="header">Sidang Skripsi</li>
            <li>
                <a href="{{ route('view-sidangTmb.index') }}">
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-sidangTmb.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_koordinator_skripsi == 1)
            <li class="header">Seminar Tugas Akhir</li>
            <li>
                <a href="{{ route('view-seminarTi.index') }}">
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-seminarTi.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            <li class="header">Sidang Tugas Akhir</li>
            <li>
                <a href="{{ route('view-sidangTi.index') }}">
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-sidangTi.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_koordinator_skripsi == 1)
            <li class="header">Sidang Pembahasan</li>
            <li>
                <a href="{{ route('view-seminarPwk.index') }}">
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-seminarPwk.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            <li class="header">Sidang Terbuka</li>
            <li>
                <a href="{{ route('view-sidangPwk.index') }}">
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-sidangPwk.index') }}">
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>