<li class="nav-item {{ Route::is('kegiatan.index') || Route::is('kegiatan.summary')
                    || Route::is('kegiatan.show') || Route::is('kegiatan.create') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#skkft-mhs">
        <i class="fas fa-bolt"></i>
        <p>SKKFT</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('kegiatan.index') || Route::is('kegiatan.create')
                         || Route::is('kegiatan.show') || Route::is('kegiatan.summary')
                         || Route::is('kegiatan.edit')|| Route::is('kegiatan-bukfis.edit') ? 'show' : '' }}" id="skkft-mhs">
        <ul class="nav nav-collapse">
            <li class=" {{ Route::is('kegiatan.index') || Route::is('kegiatan.create')
                        || Route::is('kegiatan.show')|| Route::is('kegiatan.edit')
                        || Route::is('kegiatan-bukfis.edit') ? 'active' : '' }}">
                <a href="{{ route('kegiatan.index') }}">
                    <span class="sub-item">Kegiatan</span>
                </a>
            </li>
            <li class=" {{ Route::is('kegiatan.summary') ? 'active' : '' }}">
                <a href="{{ route('kegiatan.summary') }}">
                    <span class="sub-item">Summary SKKFT</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Route::is('seminar_tmb.index') || Route::is('sidang_tmb.index')
                    || Route::is('seminar_tmb.daftar') || Route::is('seminar_tmb.show')
                    || Route::is('seminar_tmb.edit') || Route::is('sidang_tmb.edit')
                    || Route::is('sidang_tmb.daftar') || Route::is('sidang_tmb.show')
                    || Route::is('seminar_ti.index') || Route::is('sidang_ti.index')
                    || Route::is('seminar_ti.daftar') || Route::is('seminar_ti.show')
                    || Route::is('seminar_ti.edit') || Route::is('sidang_ti.daftar') 
                    || Route::is('sidang_ti.show') || Route::is('sidang_ti.edit')
                    || Route::is('seminar_pwk.index') || Route::is('sidang_pwk.index')
                    || Route::is('seminar_pwk.daftar') || Route::is('seminar_pwk.show')
                    || Route::is('seminar_pwk.edit') || Route::is('sidang_pwk.daftar') 
                    || Route::is('sidang_pwk.show') || Route::is('sidang_pwk.edit') ? 'active' : '' }}">
    @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Pertambangan')
        <a data-bs-toggle="collapse" href="#sidang-tmb-mhs">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('seminar_tmb.index') || Route::is('sidang_tmb.index')
                             || Route::is('seminar_tmb.daftar') || Route::is('seminar_tmb.show')
                             || Route::is('seminar_tmb.edit') || Route::is('sidang_tmb.edit')
                             || Route::is('sidang_tmb.daftar') || Route::is('sidang_tmb.show') ? 'show' : '' }}" id="sidang-tmb-mhs">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('seminar_tmb.index') || Route::is('seminar_tmb.daftar')
                           || Route::is('seminar_tmb.edit') || Route::is('seminar_tmb.show') ? 'active' : '' }}">
                    <a href="{{ route('seminar_tmb.index') }}">
                        <span class="sub-item">Kolokium Skripsi</span>
                    </a>
                </li>
                <li class="{{ Route::is('sidang_tmb.index') || Route::is('sidang_tmb.daftar')
                           || Route::is('sidang_tmb.show') || Route::is('sidang_tmb.edit') ? 'active' : '' }}">
                    <a href="{{ route('sidang_tmb.index') }}">
                        <span class="sub-item">Sidang Skripsi</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif

    @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Teknik Industri')
        <a data-bs-toggle="collapse" href="#sidang-ti-mhs">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('seminar_ti.index') || Route::is('sidang_ti.index')
                             || Route::is('seminar_ti.daftar') || Route::is('seminar_ti.show')
                             || Route::is('seminar_ti.edit') || Route::is('sidang_ti.daftar') 
                             || Route::is('sidang_ti.show') || Route::is('sidang_ti.edit') ? 'show' : '' }}" id="sidang-ti-mhs">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('seminar_ti.index') || Route::is('seminar_ti.daftar')
                           || Route::is('seminar_ti.show') || Route::is('seminar_ti.edit') ? 'active' : '' }}">
                    <a href="{{ route('seminar_ti.index') }}">
                        <span class="sub-item">Seminar Tugas Akhir</span>
                    </a>
                </li>
                <li  class="{{ Route::is('sidang_ti.index') || Route::is('sidang_ti.daftar') 
                            || Route::is('sidang_ti.show') || Route::is('sidang_ti.edit') ? 'active' : '' }}">
                    <a href="{{ route('sidang_ti.index') }}">
                        <span class="sub-item">Sidang Tugas Akhir</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif

    @if (auth()->user()->level == 3 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
        <a data-bs-toggle="collapse" href="#sidang-pwk-mhs">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('seminar_pwk.index') || Route::is('sidang_pwk.index')
                             || Route::is('seminar_pwk.daftar') || Route::is('seminar_pwk.show')
                             || Route::is('seminar_pwk.edit') || Route::is('sidang_pwk.daftar') 
                             || Route::is('sidang_pwk.show') || Route::is('sidang_pwk.edit') ? 'show' : '' }}" id="sidang-pwk-mhs">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('seminar_pwk.index') || Route::is('seminar_pwk.daftar') 
                           || Route::is('seminar_pwk.show') || Route::is('seminar_pwk.edit') ? 'active' : '' }}" id="sidang-pwk-mhs">
                    <a href="{{ route('seminar_pwk.index') }}">
                        <span class="sub-item">Sidang Pembahasan</span>
                    </a>
                </li>
                <li  class="{{ Route::is('sidang_pwk.index') || Route::is('sidang_pwk.daftar') 
                            || Route::is('sidang_pwk.show') || Route::is('sidang_pwk.edit') ? 'active' : '' }}" id="sidang-pwk-mhs">
                    <a href="{{ route('sidang_pwk.index') }}">
                        <span class="sub-item">Sidang Terbuka</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif
</li>