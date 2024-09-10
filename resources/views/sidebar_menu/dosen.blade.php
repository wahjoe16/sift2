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
            @include('sidebar_menu.koordinator_skripsi_tmb')
        @endif
        {{-- Akhir Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Tambang --}}
        
        {{-- Menu Pelaksanaan Sidang Untuk Kaprodi Tambang --}}
        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
            @include('sidebar_menu.kaprodi_sekprodi_tmb')
        @endif
        {{-- Akhir Menu Pelaksanaan Sidang Untuk Kaprodi Tambang --}}
        
        {{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Industri --}}
        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_koordinator_skripsi == 1)
            @include('sidebar_menu.koordinator_skripsi_ti')
        @endif
        {{-- Akhir Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Industri --}}
        
        {{-- Menu Pelaksanaan Sidang Untuk Kaprodi Teknik Industri --}}
        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
            @include('sidebar_menu.kaprodi_sekprodi_ti')
        @endif
        {{-- Akhir Menu Pelaksanaan Sidang Untuk Kaprodi Teknik Industri --}}
        
        {{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Perencanaan Wilayah dan Kota --}}
        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_koordinator_skripsi == 1)
            @include('sidebar_menu.koordinator_skripsi_pwk')
        @endif
        {{-- Akhir Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Perencanaan Wilayah dan Kota --}}

        {{-- Menu Pelaksanaan Sidang Untuk Kaprodi Perencanaan Wilayah dan Kota --}}
        @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_kaprodi == 1 || auth()->user()->status_sekprodi == 1)
            @include('sidebar_menu.kaprodi_sekprodi_pwk')
        @endif
        {{-- Akhir Menu Pelaksanaan Sidang Untuk Kaprodi Perencanaan Wilayah dan Kota --}}
        
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

{{-- Menu khusus untuk dosen pejabar dekanat --}}
@if (auth()->user()->level == 2 && auth()->user()->status_dekanat == 1)
    @include('sidebar_menu.dekanat')
@endif