<li>
    <a href="{{ route('view-seminarTi.index') }}" @if(Session::get('page')=='appSeminarTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
        <i class="fa fa-file-text-o"></i> <span>Seminar Tugas Akhir</span>
    </a>
</li>
<li>
    <a href="{{ route('view-sidangTi.index') }}" @if(Session::get('page')=='appSidangTA' ) style="background: #3c8dbc !important; color:white !important" @endif>
        <i class="fa fa-files-o"></i> <span>Sidang Tugas Akhir</span>
    </a>
</li>