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