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

            @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Pertambangan')
            <li>
                <a href="{{ route('seminar_tmb.index') }}" @if(Session::get('page')=='indexKolokium' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Kolokium Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sidang_tmb.index') }}" @if(Session::get('page')=='indexSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Sidang Skripsi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Industri')
            <li>
                <a href="{{ route('seminar_ti.index') }}" @if(Session::get('page')=='seminarTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Seminar Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sidang_ti.index') }}" @if(Session::get('page')=='sidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Sidang Tugas Akhir</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
            <li>
                <a href="{{ route('seminar_pwk.index') }}" @if(Session::get('page')=='SP' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Sidang Pembahasan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sidang_pwk.index') }}" @if(Session::get('page')=='ST' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Sidang Terbuka</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_koordinator_skripsi == 1)
            <li class="header">Kolokium Skripsi</li>
            <li>
                <a href="{{ route('view-seminarTmb.index') }}" @if(Session::get('page')=='appKolokium' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-seminarTmb.index') }}" @if(Session::get('page')=='rekapKolokium' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            <li class="header">Sidang Skripsi</li>
            <li>
                <a href="{{ route('view-sidangTmb.index') }}" @if(Session::get('page')=='appSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-sidangTmb.index') }}" @if(Session::get('page')=='rekapSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
            <li class="header">Data Lulusan</li>
            <li>
                <a href="{{ route('rekap-sidangTmb.index') }}" @if(Session::get('page')=='rekapSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekap Lulusan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_koordinator_skripsi == 1)
            <li class="header">Seminar Tugas Akhir</li>
            <li>
                <a href="{{ route('view-seminarTi.index') }}" @if(Session::get('page')=='appSeminarTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-seminarTi.index') }}" @if(Session::get('page')=='rekapSeminarTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            <li class="header">Sidang Tugas Akhir</li>
            <li>
                <a href="{{ route('view-sidangTi.index') }}" @if(Session::get('page')=='appSidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-sidangTi.index') }}" @if(Session::get('page')=='rekapSidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
            <li class="header">Data Lulusan</li>
            <li>
                <a href="{{ route('rekap-sidangTi.index') }}" @if(Session::get('page')=='rekapSidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekap Lulusan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_koordinator_skripsi == 1)
            <li class="header">Sidang Pembahasan</li>
            <li>
                <a href="{{ route('view-seminarPwk.index') }}" @if(Session::get('page')=='appPembahasan' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-seminarPwk.index') }}" @if(Session::get('page')=='rekapPembahasan' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('seminarPwkDownload.index') }}" @if(Session::get('page')=='downloadPembahasan' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-download"></i> <span>Unduh Dokumen</span>
                </a>
            </li> -->
            <li class="header">Sidang Terbuka</li>
            <li>
                <a href="{{ route('view-sidangPwk.index') }}" @if(Session::get('page')=='appTerbuka' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-upload"></i> <span>Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekap-sidangPwk.index') }}" @if(Session::get('page')=='rekapTerbuka' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
            <li class="header">Data Lulusan</li>
            <li>
                <a href="{{ route('rekap-sidangPwk.index') }}" @if(Session::get('page')=='rekapTerbuka' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa  fa-file-text"></i> <span>Rekap Lulusan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2)
            <li class="header">Bimbingan</li>
            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan')
            <li>
                <a href="{{ route('bimbinganTmb.index') }}" @if(Session::get('page')=='bimbinganTmb' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-users"></i> <span>Data Mahasiswa Bimbingan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri')
            <li>
                <a href="{{ route('bimbinganTi.index') }}" @if(Session::get('page')=='bimbinganTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-users"></i> <span>Data Mahasiswa Bimbingan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
            <li>
                <a href="{{ route('bimbinganPwk.index') }}" @if(Session::get('page')=='bimbinganPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-users"></i> <span>Data Mahasiswa Bimbingan</span>
                </a>
            </li>
            @endif

            <li class="header">Arsip</li>
            <li>
                <a href="{{ route('all-archive.index') }}" @if(Session::get('page')=='allArchive' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-book"></i> <span> Semua Arsip</span>
                </a>
            </li>
            <li>
                <a href="{{ route('my-archive.general') }}" @if(Session::get('page')=='generalArsip' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-file"></i> <span>Arsip Umum Fakultas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('my-archive.index') }}" @if(Session::get('page')=='myArchive' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-folder"></i> <span>Arsip Saya</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 1)
            <li class="header">Data User</li>
            <li>
                <a href="{{ route('admin.index') }}" @if(Session::get('page')=='indexAdmin' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-street-view"></i> <span>Admin</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.index') }}" @if(Session::get('page')=='indexDosen' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-user"></i> <span>Dosen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.index') }}" @if(Session::get('page')=='indexMhs' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-users"></i> <span>Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" @if(Session::get('page')=='indexUsers' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-users"></i> <span>Semua User</span>
                </a>
            </li>
            <li class="header">Pelaksanaan Sidang</li>
            <li>
                <a href="{{ route('adminKolokiumTmb.index') }}" @if(Session::get('page')=='adminKolokiumTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Kolokium Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSkripsiTmb.index') }}" @if(Session::get('page')=='adminSidangTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSeminarTi.index') }}" @if(Session::get('page')=='adminSeminarTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Seminar Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSidangTi.index') }}" @if(Session::get('page')=='adminSidangTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminPembahasanPwk.index') }}" @if(Session::get('page')=='adminPembahasanPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Pembahasan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminTerbukaPwk.index') }}" @if(Session::get('page')=='adminTerbukaPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Terbuka</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 1)
            <li class="header">Data Arsip</li>
            <li>
                <a href="{{ route('ft-arsip.index') }}" @if(Session::get('page')=='indexArsip' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-book"></i> <span>Semua Arsip Fakultas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('ft-arsip.general') }}" @if(Session::get('page')=='generalArsip' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-file"></i> <span>Arsip Umum Fakultas</span>
                </a>
            </li>

            @if (auth()->user()->program_studi == '' && auth()->user()->status_superadmin == 0)
            <li class="header">Pelaksanaan Sidang</li>
            <li>
                <a href="{{ route('adminKolokiumTmb.index') }}" @if(Session::get('page')=='adminKolokiumTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Kolokium Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSkripsiTmb.index') }}" @if(Session::get('page')=='adminSidangTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSeminarTi.index') }}" @if(Session::get('page')=='adminSeminarTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Seminar Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSidangTi.index') }}" @if(Session::get('page')=='adminSidangTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminPembahasanPwk.index') }}" @if(Session::get('page')=='adminPembahasanPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Pembahasan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminTerbukaPwk.index') }}" @if(Session::get('page')=='adminTerbukaPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Terbuka</span>
                </a>
            </li>
            @endif


            @if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Teknik Pertambangan')
            <li class="header">Pelaksanaan Sidang</li>
            <li>
                <a href="{{ route('adminKolokiumTmb.index') }}" @if(Session::get('page')=='adminKolokiumTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Kolokium Skripsi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSkripsiTmb.index') }}" @if(Session::get('page')=='adminSidangTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Skripsi</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Teknik Industri')
            <li class="header">Pelaksanaan Sidang</li>
            <li>
                <a href="{{ route('adminSeminarTi.index') }}" @if(Session::get('page')=='adminSeminarTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Seminar Tugas Akhir</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminSidangTi.index') }}" @if(Session::get('page')=='adminSidangTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Tugas Akhir</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
            <li class="header">Pelaksanaan Sidang</li>
            <li>
                <a href="{{ route('adminPembahasanPwk.index') }}" @if(Session::get('page')=='adminPembahasanPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Pembahasan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminTerbukaPwk.index') }}" @if(Session::get('page')=='adminTerbukaPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-check-square"></i> <span>Sidang Terbuka</span>
                </a>
            </li>
            @endif

            <li class="header">Data Master</li>
            <li>
                <a href="{{ route('tahunajaran.index') }}" @if(Session::get('page')=='indexTa' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-hourglass"></i> <span>Tahun Akademik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('semester.index') }}" @if(Session::get('page')=='indexSemester' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-hourglass-end"></i> <span>Semester</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sections.index') }}" @if(Session::get('page')=='indexSection' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-folder"></i> <span>Bidang Arsip</span>
                </a>
            </li>
            <li>
                <a href="{{ route('category-archive.index') }}" @if(Session::get('page')=='indexCatArsip' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-cube"></i> <span>Kategori Arsip</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sub-category-archive.index') }}" @if(Session::get('page')=='indexSubCatArsip' ) style="background: #3c8dbc !important; color:white !important" @endif>
                    <i class="fa fa-navicon"></i> <span>Sub Kategori Arsip</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 0)
            <li class="header">Data User</li>
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
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>