<li class="nav-item {{ Route::is('ft-arsip.index') || Route::is('ft-arsip.general')
                    || Route::is('ft-arsip.show') || Route::is('ft-arsip.create')
                    || Route::is('ft-arsip.edit') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#arsip-admin">
        <i class="fas fa-folder-open"></i>
        <p>Data Arsip</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('ft-arsip.index') || Route::is('ft-arsip.create')
                         || Route::is('ft-arsip.edit') || Route::is('ft-arsip.general')
                         || Route::is('ft-arsip.show') ? 'show' : '' }}" id="arsip-admin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('ft-arsip.index') || Route::is('ft-arsip.create')
                       || Route::is('ft-arsip.edit') || Route::is('ft-arsip.show') ? 'active' : '' }}">
                <a href="{{ route('ft-arsip.index') }}">
                    <span class="sub-item">Semua Arsip Fakultas</span>
                </a>
            </li>
            <li class="{{ Route::is('ft-arsip.general') ? 'active' : '' }}">
                <a href="{{ route('ft-arsip.general') }}">
                <span class="sub-item">Arsip Umum Fakultas</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Route::is('alumni.index') || Route::is('masukan-alumni.index') 
                    || Route::is('alumni.show') || Route::is('alumni.edit') 
                    || Route::is('reset-password-alumni.index') || Route::is('alumni.reset-password')
                    || Route::is('alumni.import-page') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#alumni-admin">
        <i class="fas fa-user-tie"></i>
        <p>Alumni</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('alumni.index') || Route::is('alumni.create') 
                         || Route::is('alumni.show') || Route::is('alumni.edit')
                         || Route::is('alumni.reset-password') || Route::is('masukan-alumni.index')
                         || Route::is('reset-password-alumni.index') || Route::is('alumni.import-page') ? 'show' : '' }}" id="alumni-admin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('alumni.index') || Route::is('alumni.create') 
                       || Route::is('alumni.show') || Route::is('alumni.edit')
                       || Route::is('alumni.reset-password') || Route::is('alumni.import-page') ? 'active' : '' }}">
                <a href="{{ route('alumni.index') }}">
                    <span class="sub-item">Data Alumni</span>
                </a>
            </li>
            <li class="{{ Route::is('masukan-alumni.index') ? 'active' : '' }}">
                <a href="{{ route('masukan-alumni.index') }}">
                <span class="sub-item">Saran & Masukan Alumni</span>
                </a>
            </li>
            <li class="{{ Route::is('reset-password-alumni.index') ? 'active' : '' }}">
                <a href="{{ route('reset-password-alumni.index') }}">
                <span class="sub-item">Permintaan Reset Password</span>
                </a>
            </li>
        </ul>
    </div>
</li>

{{-- Menu Untuk Admin Fakultas --}}
@if (auth()->user()->program_studi == '' && auth()->user()->status_superadmin == 0)

<li class="nav-item {{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show')
                    || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index')
                    || Route::is('adminSeminarTi.index') || Route::is('adminSidangTi.index')
                    || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index')
                    || Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index')
                    || Route::is('adminPembahasanPwk.index') || Route::is('adminSkripsiTmb.show')
                    || Route::is('adminSeminarTi.show')|| Route::is('adminSidangTi.show')
                    || Route::is('adminPembahasanPwk.show')|| Route::is('adminTerbukaPwk.show') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#sidang-superadmin">
        <i class="fas fa-graduation-cap"></i>
        <p>Pelaksanaan Sidang</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show')
                         || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index')
                         || Route::is('adminSeminarTi.index') || Route::is('adminSidangTi.index')
                         || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index')
                         || Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index')
                         || Route::is('adminPembahasanPwk.index') || Route::is('adminSkripsiTmb.show')
                         || Route::is('adminSeminarTi.show')|| Route::is('adminSidangTi.show')
                         || Route::is('adminPembahasanPwk.show')|| Route::is('adminTerbukaPwk.show') ? 'show' : '' }}" id="sidang-superadmin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show')
                       || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index')
                       || Route::is('adminSkripsiTmb.show') ? 'active' : '' }}">
                <a href="{{ route('adminKolokiumTmb.index') }}">
                    <span class="sub-item">Teknik Pertambangan</span>
                </a>
            </li>
            <li class="{{ Route::is('adminSeminarTi.index') || Route::is('adminSeminarTi.show')
                       || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index')
                       || Route::is('adminSeminarTi.show')|| Route::is('adminSidangTi.show') ? 'active' : '' }}">
                <a href="{{ route('adminSeminarTi.index') }}">
                    <span class="sub-item">Teknik Industri</span>
                </a>
            </li>
            <li class="{{ Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index')
                       || Route::is('adminPembahasanPwk.index') 
                       || Route::is('adminPembahasanPwk.show')|| Route::is('adminTerbukaPwk.show') ? 'active' : '' }}">
                <a href="{{ route('adminPembahasanPwk.index') }}">
                    <span class="sub-item">Perencanaan Wilayah dan Kota</span>
                </a>
            </li>
        </ul>
    </div>
</li>
    
@endif

{{-- Menu Pelaksanaan Sidang Untuk Admin Program Studi Tambang --}}
@if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Teknik Pertambangan')

    <li class="nav-item {{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show')
                        || Route::is('adminSkripsiTmb.show') || Route::is('adminSkripsiTmb.index')
                        || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index') ? 'active' : '' }}">
        <a data-bs-toggle="collapse" href="#sidang-tambang-admin">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show')
                             || Route::is('adminSkripsiTmb.show') || Route::is('adminSkripsiTmb.index') 
                             || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index') ? 'show' : '' }}" id="sidang-tambang-admin">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show')
                           || Route::is('adminSkripsiTmb.show') || Route::is('adminSkripsiTmb.index')
                           || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index') ? 'active' : '' }}">
                    <a href="{{ route('adminKolokiumTmb.index') }}">
                        <span class="sub-item">Teknik Pertambangan</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    
@endif

{{-- Menu Pelaksanaan Sidang Untuk Admin Program Studi Teknik Industri --}}
@if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Teknik Industri')

    <li class="nav-item {{ Route::is('adminSeminarTi.index') || Route::is('adminSidangTi.index')
                        || Route::is('adminSidangTi.show') || Route::is('adminSeminarTi.show')
                        || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index') ? 'active' : '' }}">
        <a data-bs-toggle="collapse" href="#sidang-ti-admin">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('adminSeminarTi.index') || Route::is('adminSidangTi.index')
                             || Route::is('adminSidangTi.show') || Route::is('adminSeminarTi.show')
                             || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index') ? 'show' : '' }}" id="sidang-ti-admin">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('adminSeminarTi.index') || Route::is('adminSidangTi.index')
                           || Route::is('adminSidangTi.show') || Route::is('adminSeminarTi.show')
                           || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index') ? 'active' : '' }}">
                    <a href="{{ route('adminSeminarTi.index') }}">
                        <span class="sub-item">Teknik Industri</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    
@endif

{{-- Menu Pelaksanaan Sidang Untuk Admin Program Studi PWK --}}
@if (auth()->user()->level == 1 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
    
    <li class="nav-item {{ Route::is('adminPembahasanPwk.index') || Route::is('adminTerbukaPwk.index')
                        || Route::is('adminPembahasanPwk.show') || Route::is('adminTerbukaPwk.show')
                        || Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index') ? 'active' : '' }}">
        <a data-bs-toggle="collapse" href="#sidang-pwk-admin">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('adminPembahasanPwk.index') || Route::is('adminTerbukaPwk.index')
                             || Route::is('adminPembahasanPwk.show') || Route::is('adminTerbukaPwk.show')
                             || Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index') ? 'show' : '' }}" id="sidang-pwk-admin">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('adminPembahasanPwk.index') || Route::is('adminTerbukaPwk.index')
                           || Route::is('adminPembahasanPwk.show') || Route::is('adminTerbukaPwk.show')
                           || Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index') ? 'active' : '' }}">
                    <a href="{{ route('adminPembahasanPwk.index') }}">
                        <span class="sub-item">Perencanaan Wilayah dan Kota</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    
@endif

<li class="nav-item {{ Route::is('tahunajaran.index') || Route::is('tahunajaran.edit') 
                    || Route::is('semester.index') || Route::is('semester.edit') 
                    || Route::is('sections.index') || Route::is('category-archive.index')
                    || Route::is('category-archive.edit') || Route::is('category-archive.create')
                    || Route::is('sub-category-archive.index') || Route::is('sub-category-archive.create')
                    || Route::is('sub-category-archive.edit') || Route::is('posisi-pekerjaan.index')
                    || Route::is('posisi-pekerjaan.create') || Route::is('posisi-pekerjaan.edit') 
                    || Route::is('subposisi-pekerjaan.index') || Route::is('subposisi-pekerjaan.create')
                    || Route::is('subposisi-pekerjaan.edit') || Route::is('profesi-alumni.index')
                    || Route::is('profesi-alumni.create') || Route::is('profesi-alumni.edit')
                    || Route::is('jabatan-profesi.index') || Route::is('jabatan-profesi.create')
                    || Route::is('jabatan-profesi.edit') ? 'active' : '' }}">

    <a data-bs-toggle="collapse" href="#datamaster-admin">
        <i class="fas fa-database"></i>
        <p>Data Master</p>
        <span class="caret"></span>
    </a>

    <div class="collapse {{ Route::is('tahunajaran.index') || Route::is('tahunajaran.edit') 
                         || Route::is('semester.index') || Route::is('semester.edit') 
                         || Route::is('sections.index') || Route::is('sections.create') 
                         || Route::is('sections.edit') || Route::is('category-archive.index')
                         || Route::is('category-archive.edit')|| Route::is('category-archive.create')
                         || Route::is('sub-category-archive.index') || Route::is('sub-category-archive.create')
                         || Route::is('sub-category-archive.edit')|| Route::is('posisi-pekerjaan.index')
                         || Route::is('posisi-pekerjaan.create') || Route::is('posisi-pekerjaan.edit') 
                         || Route::is('subposisi-pekerjaan.index') || Route::is('subposisi-pekerjaan.create')
                         || Route::is('subposisi-pekerjaan.edit')|| Route::is('profesi-alumni.index')
                         || Route::is('profesi-alumni.create') || Route::is('profesi-alumni.edit')
                         || Route::is('jabatan-profesi.index') || Route::is('jabatan-profesi.create')
                         || Route::is('jabatan-profesi.edit') ? 'show' : '' }}" id="datamaster-admin">

        <ul class="nav nav-collapse">
            <li class="{{ Route::is('tahunajaran.index') || Route::is('tahunajaran.edit') ? 'active' : '' }}">
                <a href="{{ route('tahunajaran.index') }}">
                    <span class="sub-item">Tahun Akademik</span>
                </a>
            </li>
            <li class="{{ Route::is('semester.index') || Route::is('semester.edit') ? 'active' : '' }}">
                <a href="{{ route('semester.index') }}">
                    <span class="sub-item">Semester</span>
                </a>
            </li>
            <li class="{{ Route::is('sections.index') || Route::is('sections.edit')
                       || Route::is('sections.create') ? 'active' : '' }}">
                <a href="{{ route('sections.index') }}">
                    <span class="sub-item">Bidang Arsip</span>
                </a>
            </li>
            <li class="{{ Route::is('category-archive.index') || Route::is('category-archive.edit')
                       || Route::is('category-archive.create') ? 'active' : '' }}">
                <a href="{{ route('category-archive.index') }}">
                    <span class="sub-item">Kategori Arsip</span>
                </a>
            </li>
            <li class="{{ Route::is('sub-category-archive.index') || Route::is('sub-category-archive.create')
                       || Route::is('sub-category-archive.edit') ? 'active' : '' }}">
                <a href="{{ route('sub-category-archive.index') }}">
                    <span class="sub-item">Sub Kategori Arsip</span>
                </a>
            </li>
            <li class="{{ Route::is('posisi-pekerjaan.index') || Route::is('posisi-pekerjaan.create')
                       || Route::is('posisi-pekerjaan.edit') ? 'active' : '' }} ">
                <a href="{{ route('posisi-pekerjaan.index') }}">
                    <span class="sub-item">Posisi Pekerjaan Alumni</span>
                </a>
            </li>
            <li class="{{ Route::is('subposisi-pekerjaan.index') || Route::is('subposisi-pekerjaan.create')
                       || Route::is('subposisi-pekerjaan.edit') ? 'active' : '' }}">
                <a href="{{ route('subposisi-pekerjaan.index') }}">
                    <span class="sub-item">Sub Posisi Pekerjaan Alumni</span>
                </a>
            </li>
            <li class="{{ Route::is('profesi-alumni.index') || Route::is('profesi-alumni.create')
                       || Route::is('profesi-alumni.edit') ? 'active' : '' }}">
                <a href="{{ route('profesi-alumni.index') }}">
                    <span class="sub-item">Profesi Alumni</span>
                </a>
            </li>
            <li class="{{ Route::is('jabatan-profesi.index') || Route::is('jabatan-profesi.create')
                       || Route::is('jabatan-profesi.edit') ? 'active' : '' }}">
                <a href="{{ route('jabatan-profesi.index') }}">
                    <span class="sub-item">Jabatan Profesi Alumni</span>
                </a>
            </li>
        </ul>
    </div>
</li>
