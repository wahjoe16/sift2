<li class="nav-item {{ Route::is('view-seminarTmb.index') || Route::is('view-sidangTmb.index')
                    || Route::is('seminarTmbDownload.index') || Route::is('approve-seminarTmb.store')
                    || Route::is('rekap-sidangTmb.show') || Route::is('rekap-seminarTmb.show')
                    || Route::is('sidangTmbDownload.index') ? 'active' : '' }}">
    @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Teknik Pertambangan')
        <a data-bs-toggle="collapse" href="#sidang-tmb-dosen">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('view-seminarTmb.index') || Route::is('view-sidangTmb.index')
                             || Route::is('seminarTmbDownload.index') || Route::is('approve-seminarTmb.store')
                             || Route::is('approve-sidangTmb.store') || Route::is('rekap-sidangTmb.show')
                             || Route::is('rekap-seminarTmb.show') || Route::is('sidangTmbDownload.index') ? 'show' : '' }}" id="sidang-tmb-dosen">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('view-seminarTmb.index') || Route::is('seminarTmbDownload.index')
                           || Route::is('approve-seminarTmb.store') || Route::is('rekap-seminarTmb.show') ? 'active' : '' }}">
                    <a href="{{ route('view-seminarTmb.index') }}">
                        <span class="sub-item">Kolokium Skripsi</span>
                    </a>
                </li>
                <li class="{{ Route::is('view-sidangTmb.index') || Route::is('sidangTmbDownload.index')
                           || Route::is('approve-sidangTmb.store') || Route::is('rekap-sidangTmb.show') ? 'active' : '' }}">
                    <a href="{{ route('view-sidangTmb.index') }}">
                        <span class="sub-item">Sidang Skripsi</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif
</li>
