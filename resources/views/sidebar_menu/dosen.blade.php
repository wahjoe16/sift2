{{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Tambang --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_koordinator_skripsi == 1)
    @include('sidebar_menu.koordinator_skripsi_tmb')
@endif

{{-- Menu Pelaksanaan Sidang Untuk Kaprodi Tambang --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_kaprodi == 1)
    @include('sidebar_menu.kaprodi_sekprodi_tmb')
@endif

{{-- Menu Pelaksanaan Sidang Untuk Sekprodi Tambang --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan' && auth()->user()->status_sekprodi == 1)
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data Lulusan</h4>
    </li>

    <li class="nav-item {{ Route::is('rekap-sidangTmb.index') ? 'active' : '' }}">
        <a href="{{ route('rekap-sidangTmb.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <p>Rekap Lulusan</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
@endif

{{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Industri --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_koordinator_skripsi == 1)
    @include('sidebar_menu.koordinator_skripsi_ti')
@endif


{{-- Menu Pelaksanaan Sidang Untuk Kaprodi Teknik Industri --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_kaprodi == 1)
    @include('sidebar_menu.kaprodi_sekprodi_ti')
@endif

{{-- Menu Pelaksanaan Sidang Untuk Sekprodi TI --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri' && auth()->user()->status_sekprodi == 1)
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data Lulusan</h4>
    </li>

    <li class="nav-item {{ Route::is('rekap-sidangTi.index') ? 'active' : '' }}">
        <a href="{{ route('rekap-sidangTi.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <p>Rekap Lulusan</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
@endif

{{-- Menu Pelaksanaan Sidang Untuk Koordinator Skripsi Perencanaan Wilayah dan Kota --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_koordinator_skripsi == 1)
    @include('sidebar_menu.koordinator_skripsi_pwk')
@endif


{{-- Menu Pelaksanaan Sidang Untuk Kaprodi Perencanaan Wilayah dan Kota --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_kaprodi == 1)
    @include('sidebar_menu.kaprodi_sekprodi_pwk')
@endif

{{-- Menu Pelaksanaan Sidang Untuk Sekprodi PWK --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota' && auth()->user()->status_sekprodi == 1)
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data Lulusan</h4>
    </li>

    <li class="nav-item {{ Route::is('rekap-sidangPwk.index') ? 'active' : '' }}">
        <a href="{{ route('rekap-sidangPwk.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <p>Rekap Lulusan</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
@endif


{{-- Menu Pembimbingan Dosen Tambang --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan')
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data Bimbingan</h4>
    </li>
    <li class="nav-item {{ Route::is('bimbinganTmb.index') || Route::is('bimbinganTmb.showTmb1') || Route::is('bimbinganTmb.showTmb2') ? 'active' : '' }}">
        <a href="{{ route('bimbinganTmb.index') }}">
            <i class="fas fa-user-check"></i>
            <p>Data Mahasiswa Bimbingan</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
@endif

{{-- Menu Pembimbingan Dosen TI --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri')
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data Bimbingan</h4>
    </li>
    <li class="nav-item {{ Route::is('bimbinganTi.index') || Route::is('bimbinganTi.showTi1') || Route::is('bimbinganTi.showTi2') ? 'active' : '' }}">
        <a href="{{ route('bimbinganTi.index') }}">
            <i class="fas fa-user-check"></i>
            <p>Data Mahasiswa Bimbingan</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
@endif

{{-- Menu Pembimbingan Dosen PWK --}}
@if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data Bimbingan</h4>
    </li>
    <li class="nav-item {{ Route::is('bimbinganPwk.index') || Route::is('bimbinganPwk.showPwk1') || Route::is('bimbinganPwk.showPwk2') ? 'active' : '' }}">
        <a href="{{ route('bimbinganPwk.index') }}">
            <i class="fas fa-user-check"></i>
            <p>Data Mahasiswa Bimbingan</p>
            <span class="badge badge-secondary"></span>
        </a>
    </li>
@endif


<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">Arsip</h4>
</li>
<li class="nav-item {{ Route::is('all-archive.index') || Route::is('my-archive.general') 
                    || Route::is('my-archive.show') || Route::is('my-archive.index')
                    || Route::is('my-archive.create') || Route::is('my-archive.edit') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#my-arsip-dosen">
        <i class="fas fa-folder-open"></i>
        <p>Data Arsip</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('all-archive.index') || Route::is('my-archive.show')
                         || Route::is('my-archive.general') || Route::is('my-archive.index')
                         || Route::is('my-archive.create') || Route::is('my-archive.edit') ? 'show' : '' }}" id="my-arsip-dosen">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('all-archive.index') || Route::is('my-archive.show') ? 'active' : '' }}">
                <a href="{{ route('all-archive.index') }}">
                    <span class="sub-item">Semua Arsip Fakultas</span>
                </a>
            </li>
            <li class="{{ Route::is('my-archive.general') ? 'active' : '' }}">
                <a href="{{ route('my-archive.general') }}">
                <span class="sub-item">Arsip Umum Fakultas</span>
                </a>
            </li>
            <li class="{{ Route::is('my-archive.index') || Route::is('my-archive.show')
                       || Route::is('my-archive.create') || Route::is('my-archive.edit') ? 'active' : '' }}">
                <a href="{{ route('my-archive.index') }}">
                <span class="sub-item">Arsip Saya</span>
                </a>
            </li>
        </ul>
    </div>
</li>


{{-- Menu khusus untuk dosen pejabar dekanat --}}
@if (auth()->user()->level == 2 && auth()->user()->status_dekanat == 1)
    @include('sidebar_menu.dekanat')
@endif