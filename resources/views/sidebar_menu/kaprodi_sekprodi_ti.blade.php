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