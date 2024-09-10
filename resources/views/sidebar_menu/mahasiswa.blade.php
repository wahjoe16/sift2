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