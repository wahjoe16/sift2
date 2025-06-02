<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">SKKFT</h4>
</li>
<li class="nav-item {{ Route::is('dashboardSkkft.index') || Route::is('dataSkkft.index')
                    || Route::is('sertifikat.index') || Route::is('sertifikat.show') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#skkft-superadmin">
        <i class="fas fa-bolt"></i>
        <p>SKKFT</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('dashboardSkkft.index') || Route::is('dataSkkft.index')
                         || Route::is('sertifikat.index') || Route::is('sertifikat.show') ? 'show' : '' }}" id="skkft-superadmin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('dashboardSkkft.index') || Route::is('dataSkkft.index') ? 'active' : '' }}">
                <a href="{{ route('dataSkkft.index') }}">
                    <span class="sub-item">Data SKKFT</span>
                </a>
            </li>
            <li class="{{ Route::is('sertifikat.index') || Route::is('sertifikat.show') ? 'active' : '' }}">
                <a href="{{ route('sertifikat.index') }}">
                    <span class="sub-item">Sertifikat SKKFT</span>
                </a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">SKPI</h4>
</li>
<li class="nav-item {{ Route::is('skpi.index') || Route::is('skpi.list')
                    || Route::is('skpi.show') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#skpi-superadmin">
        <i class="fas fa-file-alt"></i>
        <p>SKPI</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('skpi.index') || Route::is('skpi.list')
                         || Route::is('skpi.show') ? 'show' : '' }}" id="skpi-superadmin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('skpi.index') || Route::is('skpi.show') ? 'active' : '' }}">
                <a href="{{ route('skpi.index') }}">
                    <span class="sub-item">Pengajuan SKPI</span>
                </a>
            </li>
            <li class="{{ Route::is('skpi.list') ? 'active' : '' }}">
                <a href="{{ route('skpi.list') }}">
                    <span class="sub-item">Database SKPI</span>
                </a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">Alumni</h4>
</li>
<li class="nav-item {{ Route::is('alumni.index') || Route::is('masukan-alumni.index') 
                    || Route::is('alumni.show') || Route::is('reset-password-alumni.index') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#alumni-admin">
        <i class="fas fa-user-tie"></i>
        <p>Alumni</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('alumni.index') || Route::is('masukan-alumni.index')
                         || Route::is('alumni.show') ? 'show' : '' }}" id="alumni-admin">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('alumni.index') || Route::is('alumni.show') ? 'active' : '' }}">
                <a href="{{ route('alumni.index') }}">
                    <span class="sub-item">Data Alumni</span>
                </a>
            </li>
            <li class="{{ Route::is('masukan-alumni.index') ? 'active' : '' }}">
                <a href="{{ route('masukan-alumni.index') }}">
                <span class="sub-item">Saran & Masukan Alumni</span>
                </a>
            </li>
        </ul>
    </div>
</li>
