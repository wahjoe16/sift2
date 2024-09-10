<li>
    <a href="{{ route('view-seminarPwk.index') }}" @if(Session::get('page')=='appPembahasan' ) style="background: #3c8dbc !important; color:white !important" @endif>
        <i class="fa fa-file-text-o"></i> <span>Sidang Pembahasan</span>
    </a>
</li>
<li>
    <a href="{{ route('view-sidangPwk.index') }}" @if(Session::get('page')=='appTerbuka' ) style="background: #3c8dbc !important; color:white !important" @endif>
        <i class="fa fa-files-o"></i> <span>Sidang Terbuka</span>
    </a>
</li>