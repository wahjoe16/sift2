<li class="nav-item {{ Route::is('dosen.index') || Route::is('mahasiswa.index') 
                    || Route::is('admin.index') || Route::is('users.index') 
                    || Route::is('dashboardDosen.show') || Route::is('dosen.edit')
                    || Route::is('dosen.import-page') || Route::is('mahasiswa.import-page')
                    || Route::is('dashboardMahasiswa.show') || Route::is('mahasiswa.edit')
                    || Route::is('admin.edit') || Route::is('users.show') ? 'active' : '' }}">

    <a data-bs-toggle="collapse" href="#users-superadmin">
        <i class="fas fa-user-friends"></i>
        <p>Data Users</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('dosen.index') || Route::is('mahasiswa.index') 
                         || Route::is('admin.index') || Route::is('users.index') 
                         || Route::is('dashboardDosen.show') || Route::is('dosen.edit')
                         || Route::is('dosen.import-page') || Route::is('mahasiswa.import-page')
                         || Route::is('dashboardMahasiswa.show') || Route::is('mahasiswa.edit')
                         || Route::is('admin.edit') || Route::is('users.show') ? 'show' : '' }}" id="users-superadmin">

        <ul class="nav nav-collapse">
            <li class="{{ Route::is('dosen.index') || Route::is('dashboardDosen.show') 
                       || Route::is('dosen.edit') || Route::is('dosen.import-page') ? 'active' : '' }}">
                <a href="{{ route('dosen.index') }}">
                    <span class="sub-item">Dosen</span>
                </a>
            </li>
            <li class="{{ Route::is('mahasiswa.index') || Route::is('mahasiswa.import-page')
                       || Route::is('dashboardMahasiswa.show') || Route::is('mahasiswa.edit') ? 'active' : '' }}">
                <a href="{{ route('mahasiswa.index') }}">
                    <span class="sub-item">Mahasiswa</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.index') || Route::is('admin.edit') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}">
                    <span class="sub-item">Admin</span>
                </a>
            </li>
            <li class="{{ Route::is('users.index') || Route::is('users.show') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <span class="sub-item">All User</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Route::is('adminKolokiumTmb.index') || Route::is('adminKolokiumTmb.show') 
                    || Route::is('adminSeminarTi.index') || Route::is('adminPembahasanPwk.index')
                    || Route::is('seminarTmbDownload.index') || Route::is('sidangTmbDownload.index')
                    || Route::is('seminarTiDownload.index') || Route::is('sidangTiDownload.index')
                    || Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index')
                    || Route::is('adminPembahasanPwk.index') || Route::is('adminSkripsiTmb.show')
                    || Route::is('adminSkripsiTi.show') || Route::is('adminSeminarTi.show')
                    || Route::is('adminPembahasanPwk.show') || Route::is('adminTerbukaPwk.show') ? 'active' : '' }}">
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
                         || Route::is('adminSeminarTi.show') || Route::is('adminSidangTi.show')
                         || Route::is('adminPembahasanPwk.show') || Route::is('adminTerbukaPwk.show') ? 'show' : '' }}" id="sidang-superadmin">
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
                       || Route::is('adminSidangTi.show') ? 'active' : '' }}">
                <a href="{{ route('adminSeminarTi.index') }}">
                    <span class="sub-item">Teknik Industri</span>
                </a>
            </li>
            <li class="{{ Route::is('seminarPwkDownload.index') || Route::is('sidangPwkDownload.index')
                       || Route::is('adminPembahasanPwk.index') || Route::is('adminPembahasanPwk.show')
                       || Route::is('adminTerbukaPwk.show') ? 'active' : '' }}">
                <a href="{{ route('adminPembahasanPwk.index') }}">
                    <span class="sub-item">Perencanaan Wilayah dan Kota</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Route::is('dashboardSkkft.index') || Route::is('dataSkkft.index')
                    || Route::is('skkft.show') || Route::is('approveKegiatan.edit') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#skkft-superadmin">
        <i class="fas fa-bolt"></i>
        <p>SKKFT</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('dashboardSkkft.index') || Route::is('dataSkkft.index')
                         || Route::is('skkft.show') || Route::is('approveKegiatan.edit')  ? 'show' : '' }}" id="skkft-superadmin">
        <ul class="nav nav-collapse {{ Route::is('dashboardSkkft.index') || Route::is('dataSkkft.index')
                                    || Route::is('approveKegiatan.edit') ? 'active' : '' }}">
            <li class="{{ Route::is('dashboardSkkft.index') || Route::is('approveKegiatan.edit') ? 'active' : '' }}">
                <a href="{{ route('dashboardSkkft.index') }}">
                    <span class="sub-item">Pengajuan Kegiatan</span>
                </a>
            </li>
            <li class="{{ Route::is('dataSkkft.index') || Route::is('skkft.show')  ? 'active' : '' }}">
                <a href="{{ route('dataSkkft.index') }}">
                    <span class="sub-item">Database Kegiatan SKKFT</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Route::is('category-skkft.index') || Route::is('subcategory-skkft.index') 
                    || Route::is('tingkat-skkft.index') || Route::is('jabatan-skkft.index') 
                    || Route::is('prestasi-skkft.index') || Route::is('poin-skkft.index')
                    || Route::is('category-skkft.create') || Route::is('category-skkft.edit')
                    || Route::is('subcategory-skkft.create') || Route::is('subcategory-skkft.edit')
                    || Route::is('tingkat-skkft.create') || Route::is('tingkat-skkft.edit')
                    || Route::is('jabatan-skkft.create') || Route::is('jabatan-skkft.edit')
                    || Route::is('prestasi-skkft.create') || Route::is('prestasi-skkft.edit')
                    || Route::is('poin-skkft.create') || Route::is('poin-skkft.edit') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#data-master-skkft-superadmin">
        <i class="fas fa-database"></i>
        <p>Data Master SKKFT</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('category-skkft.index') || Route::is('subcategory-skkft.index') 
                         || Route::is('tingkat-skkft.index') || Route::is('jabatan-skkft.index') 
                         || Route::is('prestasi-skkft.index') || Route::is('poin-skkft.index')
                         || Route::is('category-skkft.create') || Route::is('category-skkft.edit')
                         || Route::is('subcategory-skkft.create') || Route::is('subcategory-skkft.edit')
                         || Route::is('tingkat-skkft.create') || Route::is('tingkat-skkft.edit')
                         || Route::is('jabatan-skkft.create') || Route::is('jabatan-skkft.edit')
                         || Route::is('prestasi-skkft.create') || Route::is('prestasi-skkft.edit')
                         || Route::is('poin-skkft.create') || Route::is('poin-skkft.edit') ? 'show' : '' }}" id="data-master-skkft-superadmin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('category-skkft.index') || Route::is('category-skkft.create') 
                       || Route::is('category-skkft.edit') ? 'active' : '' }}">
                <a href="{{ route('category-skkft.index') }}">
                    <span class="sub-item">Kategori SKKFT</span>
                </a>
            </li>
            <li class="{{ Route::is('subcategory-skkft.index')  || Route::is('subcategory-skkft.create')
                       || Route::is('subcategory-skkft.edit') ? 'active' : '' }}">
                <a href="{{ route('subcategory-skkft.index') }}">
                    <span class="sub-item">Sub Kategori SKKFT</span>
                </a>
            </li>
            <li class="{{ Route::is('tingkat-skkft.index')|| Route::is('tingkat-skkft.create')
                       || Route::is('tingkat-skkft.edit') ? 'active' : '' }}">
                <a href="{{ route('tingkat-skkft.index') }}">
                    <span class="sub-item">Tingkat SKKFT</span>
                </a>
            </li>
            <li class="{{ Route::is('jabatan-skkft.index') || Route::is('jabatan-skkft.create')
                       || Route::is('jabatan-skkft.edit') ? 'active' : '' }}">
                <a href="{{ route('jabatan-skkft.index') }}">
                    <span class="sub-item">Jabatan SKKFT</span>
                </a>
            </li>
            <li class="{{ Route::is('prestasi-skkft.index') || Route::is('prestasi-skkft.create')
                       || Route::is('prestasi-skkft.edit') ? 'active' : '' }} ">
                <a href="{{ route('prestasi-skkft.index') }}">
                    <span class="sub-item">Prestasi SKKFT</span>
                </a>
            </li>
            <li class="{{ Route::is('poin-skkft.index') || Route::is('poin-skkft.create')
                       || Route::is('poin-skkft.edit') ? 'active' : '' }} ">
                <a href="{{ route('poin-skkft.index') }}">
                    <span class="sub-item">Poin SKKFT</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Route::is('skpi.index') || Route::is('skpi.list')
                    || Route::is('skpi.edit') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#skpi-superadmin">
        <i class="fas fa-file-alt"></i>
        <p>SKPI</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('skpi.index') || Route::is('skpi.list')
                         || Route::is('skpi.edit') ? 'show' : '' }}" id="skpi-superadmin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('skpi.index') ? 'active' : '' }}">
                <a href="{{ route('skpi.index') }}">
                    <span class="sub-item">Pengajuan SKPI</span>
                </a>
            </li>
            <li class="{{ Route::is('skpi.list') || Route::is('skpi.edit') ? 'active' : '' }}">
                <a href="{{ route('skpi.list') }}">
                    <span class="sub-item">Database SKPI</span>
                </a>
            </li>
        </ul>
    </div>
</li>
