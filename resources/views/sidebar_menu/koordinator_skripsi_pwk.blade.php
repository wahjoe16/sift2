<li class="nav-item {{ Route::is('view-seminarPwk.index') || Route::is('view-sidangPwk.index')
                    || Route::is('seminarPwkDownload.index') || Route::is('approve-seminarPwk.store')
                    || Route::is('rekap-sidangPwk.show') || Route::is('rekap-seminarPwk.show')
                    || Route::is('sidangPwkDownload.index') || Route::is('approve-sidangPwk.store') ? 'active' : '' }}">
    @if (auth()->user()->level == 2 && auth()->user()->program_studi == 'Perencanaan Wilayah dan Kota')
        <a data-bs-toggle="collapse" href="#sidang-tmb-dosen">
            <i class="fas fa-graduation-cap"></i>
            <p>Pelaksanaan Sidang</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ Route::is('view-seminarPwk.index') || Route::is('view-sidangPwk.index')
                             || Route::is('seminarPwkDownload.index') || Route::is('approve-seminarPwk.store')
                             || Route::is('approve-sidangPwk.store') || Route::is('rekap-sidangPwk.show')
                             || Route::is('rekap-seminarPwk.show') || Route::is('sidangPwkDownload.index') ? 'show' : '' }}" id="sidang-tmb-dosen">
            <ul class="nav nav-collapse">
                <li class="{{ Route::is('view-seminarPwk.index') || Route::is('seminarPwkDownload.index')
                           || Route::is('approve-seminarPwk.store') || Route::is('rekap-seminarPwk.show') ? 'active' : '' }}">
                    <a href="{{ route('view-seminarPwk.index') }}">
                        <span class="sub-item">Sidang Pembahasan</span>
                    </a>
                </li>
                <li class="{{ Route::is('view-sidangPwk.index') || Route::is('sidangPwkDownload.index')
                           || Route::is('approve-sidangPwk.store') || Route::is('rekap-sidangPwk.show') ? 'active' : '' }}">
                    <a href="{{ route('view-sidangPwk.index') }}">
                        <span class="sub-item">Sidang Terbuka</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif
</li>
