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
            <a href="{{ route('alumni.index') }}" @if(Session::get('page')=='indexAlumni' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-database"></i> <span>Data Alumni</span>
            </a>
            <a href="{{ route('masukan-alumni.index') }}" @if(Session::get('page')=='indexAlumni' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-long-arrow-down"></i> <span>Saran & Masukan Alumni</span>
            </a>
            <a href="{{ route('reset-password-alumni.index') }}" @if(Session::get('page')=='indexAlumni' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-unlock-alt"></i> <span>Permintaan Reset Password</span>
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
        <li>
            <a href="{{ route('posisi-pekerjaan.index') }}" @if(Session::get('page')=='indexPosisi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-navicon"></i> <span>Posisi Pekerjaan Alumni</span>
            </a>
        </li>
        <li>
            <a href="{{ route('subposisi-pekerjaan.index') }}" @if(Session::get('page')=='indexSubPosisi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-navicon"></i> <span>Sub Posisi Pekerjaan Alumni</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profesi-alumni.index') }}" @if(Session::get('page')=='indexProfesi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-navicon"></i> <span>Profesi Alumni</span>
            </a>
        </li>
        <li>
            <a href="{{ route('jabatan-profesi.index') }}" @if(Session::get('page')=='indexJabatanProfesi' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-navicon"></i> <span>Jabatan Profesi Alumni</span>
            </a>
        </li>
    </ul>
</li>