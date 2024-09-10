<li>
    <a href="{{ route('view-seminarTmb.index') }}" @if(Session::get('page')=='appKolokium' ) style="background: #3c8dbc !important; color:white !important" @endif>
        <i class="fa fa-file-text-o"></i> <span>Kolokium Skripsi</span>
    </a>
</li>
<li>
    <a href="{{ route('view-sidangTmb.index') }}" @if(Session::get('page')=='appSkripsi' ) style="background: #3c8dbc !important; color:white !important" @endif>
        <i class="fa fa-files-o"></i> <span>Sidang Skripsi</span>
    </a>
</li>