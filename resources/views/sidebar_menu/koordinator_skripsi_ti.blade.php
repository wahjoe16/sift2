<li class="nav-item {{ Route::is('view-seminarTi.index') || Route::is('view-sidangTi.index')
                    || Route::is('seminarTiDownload.index') || Route::is('approve-seminarTi.store')
                    || Route::is('rekap-sidangTi.show') || Route::is('rekap-seminarTi.show')
                    || Route::is('sidangTiDownload.index') || Route::is('approve-sidangTi.store') ? 'active' : '' }}">
    @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Industri')
        <a data-bs-toggle="collapse" href="#sidang-ti-dosen">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('view-seminarTi.index') || Route::is('view-sidangTi.index')
                             || Route::is('seminarTiDownload.index') || Route::is('approve-seminarTi.store')
                             || Route::is('approve-sidangTi.store') || Route::is('rekap-sidangTi.show')
                             || Route::is('rekap-seminarTi.show') || Route::is('sidangTiDownload.index') ? 'show' : '' }}" id="sidang-ti-dosen">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('view-seminarTi.index') || Route::is('seminarTiDownload.index')
                           || Route::is('approve-seminarTi.store') || Route::is('rekap-seminarTi.show') ? 'active' : '' }}">
                    <a href="{{ route('view-seminarTi.index') }}">
                        <span class="sub-item">Seminar Tugas Akhir</span>
                    </a>
                </li>
                <li class="{{ Route::is('view-sidangTi.index') || Route::is('sidangTiDownload.index')
                           || Route::is('approve-sidangTi.store') || Route::is('rekap-sidangTi.show') ? 'active' : '' }}">
                    <a href="{{ route('view-sidangTi.index') }}">
                        <span class="sub-item">Sidang Tugas Akhir</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif
</li>
