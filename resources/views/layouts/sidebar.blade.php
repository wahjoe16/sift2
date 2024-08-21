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

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-street-view"></i>
                        <span>SKKFT</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('kegiatan.index') }}" @if(Session::get('page')=='indexKegiatanSkkft') style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-leanpub"></i> <span>Kegiatan SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kegiatan.summary') }}" @if(Session::get('page')=='summaryKegiatanSkkft') style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-database"></i> <span>Rangkuman Kegiatan SKKFT</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Pelaksanaan Sidang</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        {{-- Menu Pelaksanaan Sidang Untuk Mahasiswa Tambang --}}
                        @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Pertambangan')
                            <li>
                                <a href="{{ route('seminar_tmb.index') }}" @if(Session::get('page')=='indexKolokium' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-level-up"></i> <span>Kolokium Skripsi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sidang_tmb.index') }}" @if(Session::get('page')=='indexSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Sidang Skripsi</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Mahasiswa Tambang --}}

                        {{-- Menu Pelaksanaan Sidang Untuk Mahasiswa Industri --}}
                        @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Industri')
                            <li>
                                <a href="{{ route('seminar_ti.index') }}" @if(Session::get('page')=='seminarTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-level-up"></i> <span>Seminar Tugas Akhir</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sidang_ti.index') }}" @if(Session::get('page')=='sidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Sidang Tugas Akhir</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Mahasiswa Industri --}}

                        {{-- Menu Pelaksanaan Sidang Untuk Mahasiswa Perencanaan Wilayah dan Kota --}}
                        @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
                            <li>
                                <a href="{{ route('seminar_pwk.index') }}" @if(Session::get('page')=='SP' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-level-up"></i> <span>Sidang Pembahasan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sidang_pwk.index') }}" @if(Session::get('page')=='ST' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Sidang Terbuka</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Mahasiswa Perencanaan Wilayah dan Kota --}}
                    </ul>
                </li>

            @endif
            {{-- Akhir Menu Untuk Mahasiswa --}}
            
            @if (auth()->user()->level == 2)

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Pelaksanaan Sidang</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        {{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Tambang --}}
                        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_koordinator_skripsi == 1)
                            <li class="header">Kolokium Skripsi</li>
                            <li>
                                <a href="{{ route('view-seminarTmb.index') }}" @if(Session::get('page')=='appKolokium' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-level-up"></i> <span>Pengajuan</span>
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
                                    <i class="fa fa-level-up"></i> <span>Pengajuan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rekap-sidangTmb.index') }}" @if(Session::get('page')=='rekapSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Tambang --}}
                        
                        {{-- Menu Pelaksanaan Sidang Untuk Kaprodi Tambang --}}
                        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
                            <li class="header">Data Lulusan</li>
                            <li>
                                <a href="{{ route('rekap-sidangTmb.index') }}" @if(Session::get('page')=='rekapSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Rekap Lulusan</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Kaprodi Tambang --}}
                        
                        {{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Industri --}}
                        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_koordinator_skripsi == 1)
                            <li class="header">Seminar Tugas Akhir</li>
                            <li>
                                <a href="{{ route('view-seminarTi.index') }}" @if(Session::get('page')=='appSeminarTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-level-up"></i> <span>Pengajuan</span>
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
                                    <i class="fa fa-level-up"></i> <span>Pengajuan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rekap-sidangTi.index') }}" @if(Session::get('page')=='rekapSidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Industri --}}
                        
                        {{-- Menu Pelaksanaan Sidang Untuk Kaprodi Teknik Industri --}}
                        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
                            <li class="header">Data Lulusan</li>
                            <li>
                                <a href="{{ route('rekap-sidangTi.index') }}" @if(Session::get('page')=='rekapSidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Rekap Lulusan</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Kaprodi Teknik Industri --}}
                        
                        {{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Perencanaan Wilayah dan Kota --}}
                        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_koordinator_skripsi == 1)
                            <li class="header">Sidang Pembahasan</li>
                            <li>
                                <a href="{{ route('view-seminarPwk.index') }}" @if(Session::get('page')=='appPembahasan' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-level-up"></i> <span>Pengajuan</span>
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
                                    <i class="fa fa-level-up"></i> <span>Pengajuan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rekap-sidangPwk.index') }}" @if(Session::get('page')=='rekapTerbuka' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Rekapitulasi</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Perencanaan Wilayah dan Kota --}}

                        {{-- Menu Pelaksanaan Sidang Untuk Kaprodi Perencanaan Wilayah dan Kota --}}
                        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
                            <li class="header">Data Lulusan</li>
                            <li>
                                <a href="{{ route('rekap-sidangPwk.index') }}" @if(Session::get('page')=='rekapTerbuka' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa  fa-file-text"></i> <span>Rekap Lulusan</span>
                                </a>
                            </li>
                        @endif
                        {{-- Akhir Menu Pelaksanaan Sidang Untuk Kaprodi Perencanaan Wilayah dan Kota --}}
                        
                        {{-- Menu Untuk Dosen --}}
                        @if (auth()->user()->level == 2)
                            <li class="header">Bimbingan</li>
                            {{-- Menu Pembimbingan Dosen Tambang --}}
                            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan')
                                <li>
                                    <a href="{{ route('bimbinganTmb.index') }}" @if(Session::get('page')=='bimbinganTmb' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                        <i class="fa fa-users"></i> <span>Data Mahasiswa Bimbingan</span>
                                    </a>
                                </li>
                            @endif
                            {{-- Akhir Menu Pembimbingan Dosen Tambang --}}
                            
                            {{-- Menu Pembimbingan Dosen TI --}}
                            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri')
                                <li>
                                    <a href="{{ route('bimbinganTi.index') }}" @if(Session::get('page')=='bimbinganTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                        <i class="fa fa-users"></i> <span>Data Mahasiswa Bimbingan</span>
                                    </a>
                                </li>
                            @endif
                            {{-- Akhir Menu Pembimbingan Dosen TI --}}

                            {{-- Menu Pembimbingan Dosen PWK --}}
                            @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
                                <li>
                                    <a href="{{ route('bimbinganPwk.index') }}" @if(Session::get('page')=='bimbinganPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                        <i class="fa fa-users"></i> <span>Data Mahasiswa Bimbingan</span>
                                    </a>
                                </li>
                            @endif
                            {{-- Akhir Menu Pembimbingan Dosen PWK --}}
                        @endif
                                
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Arsip Fakultas</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
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
                    </ul>
                </li>
                @if (auth()->user()->level == 2 && auth()->user()->status_dekanat == 1)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-street-view"></i>
                            <span>SKKFT</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="" @if(Session::get('page')=='indexKegiatanSkkft') style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-leanpub"></i> <span>Data SKKFT</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sertifikat.index') }}" @if(Session::get('page')=='summaryKegiatanSkkft') style="background: #3c8dbc !important; color:white !important" @endif>
                                    <i class="fa fa-database"></i> <span>Sertifikat SKKFT</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i>
                        <span>SKPI</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('skpi.index') }}" @if(Session::get('page')=='') style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-leanpub"></i> <span>Pengajuan SKPI</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('skpi.list') }}" @if(Session::get('page')=='') style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-database"></i> <span>Data SKPI</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            @endif
               
            {{-- Akhir Menu untuk Dosen --}}
            
            {{-- Menu Untuk Superadmin --}}
            @if (auth()->user()->level == 1 && auth()->user()->status_superadmin == 1)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Data User</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
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
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Pelaksanaan Sidang</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('adminKolokiumTmb.index') }}" @if(Session::get('page')=='adminKolokiumTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-laptop"></i> <span>Kolokium Skripsi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminSkripsiTmb.index') }}" @if(Session::get('page')=='adminSidangTambang' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-laptop"></i> <span>Sidang Skripsi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminSeminarTi.index') }}" @if(Session::get('page')=='adminSeminarTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-laptop"></i> <span>Seminar Tugas Akhir</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminSidangTi.index') }}" @if(Session::get('page')=='adminSidangTi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-laptop"></i> <span>Sidang Tugas Akhir</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminPembahasanPwk.index') }}" @if(Session::get('page')=='adminPembahasanPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-laptop"></i> <span>Sidang Pembahasan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminTerbukaPwk.index') }}" @if(Session::get('page')=='adminTerbukaPwk' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-laptop"></i> <span>Sidang Terbuka</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-street-view"></i>
                        <span>SKKFT</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('dashboardSkkft.index') }}" @if(Session::get('page')=='indexCatSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-level-up"></i> <span>Pengajuan Kegiatan SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dataSkkft.index') }}" @if(Session::get('page')=='indexCatSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-database"></i> <span>Database Kegiatan SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category-skkft.index') }}" @if(Session::get('page')=='indexCatSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-cube"></i> <span>Kategori SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subcategory-skkft.index') }}" @if(Session::get('page')=='indexSubcatSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-cubes"></i> <span>Sub Kategori SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tingkat-skkft.index') }}" @if(Session::get('page')=='indexTingkatSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-line-chart"></i> <span>Tingkat SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jabatan-skkft.index') }}" @if(Session::get('page')=='indexJabatanSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-shield"></i> <span>Jabatan SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('prestasi-skkft.index') }}" @if(Session::get('page')=='indexPrestasiSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-trophy"></i> <span>Prestasi SKKFT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('poin-skkft.index') }}" @if(Session::get('page')=='indexPoinSkkft' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-circle-o"></i> <span>Poin SKKFT</span>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i>
                        <span>SKPI</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('skpi.index') }}" @if(Session::get('page')=='') style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-level-up"></i> <span>Pengajuan SKPI</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('skpi.list') }}" @if(Session::get('page')=='') style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-database"></i> <span>Data SKPI</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
            @endif
            {{-- Akhir Menu untuk Superadmin --}}
            
            {{-- Menu Untuk Admin --}}
            @if (auth()->user()->level == 1)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder-open-o"></i>
                        <span>Data Arsip</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
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
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-male"></i>
                        <span>Alumni</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('alumni.index') }}" @if(Session::get('page')=='indexArsip' ) style="background: #3c8dbc !important; color:white !important" @endif>
                                <i class="fa fa-database"></i> <span>Data Alumni</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Menu Untuk Admin Fakultas --}}
                @if (auth()->user()->program_studi == '' && auth()->user()->status_superadmin == 0)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-graduation-cap"></i> <span>Pelaksanaan Sidang</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
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
                        </ul>
                    </li>
                    
                @endif
                {{-- Akhir Menu Untuk Admin Fakultas --}}

                {{-- Menu Pelaksanaan Sidang Untuk Admin Program Studi Tambang --}}
                @if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Teknik Pertambangan')
                    
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-graduation-cap"></i> <span>Pelaksanaan Sidang</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
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
                        </ul>
                    </li>
                    
                @endif
                {{-- Akhir Menu Pelaksanaan Sidang Untuk Admin Program Studi Tambang --}}

                {{-- Menu Pelaksanaan Sidang Untuk Admin Program Studi Teknik Industri --}}
                @if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Teknik Industri')
                    
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-graduation-cap"></i> <span>Pelaksanaan Sidang</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
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
                        </ul>
                    </li>
                    
                @endif
                {{-- Akhir Menu Pelaksanaan Sidang Untuk Admin Program Studi Teknik Industri --}}

                {{-- Menu Pelaksanaan Sidang Untuk Admin Program Studi PWK --}}
                @if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
                    
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-graduation-cap"></i> <span>Pelaksanaan Sidang</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
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
                        </ul>
                    </li>
                    
                @endif
                {{-- Akhir Menu Pelaksanaan Sidang Untuk Admin Program Studi PWK --}}
                
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-hdd-o"></i> <span>Data Master</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
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
                    </ul>
                </li>
                
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