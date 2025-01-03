<li class="treeview">
    <a href="#">
        <i class="fa fa-street-view"></i>
        <span>SKKFT</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="" @if(Session::get('page')=='indexKegiatanSkkft') style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-leanpub"></i> <span>Data SKKFT</span>
            </a>
        </li>
        <li>
            <a href="{{ route('sertifikat.index') }}" @if(Session::get('page')=='summaryKegiatanSkkft') style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-database"></i> <span>Sertifikat SKKFT</span>
            </a>
        </li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-newspaper-o"></i>
        <span>SKPI</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="{{ route('skpi.index') }}" @if(Session::get('page')=='') style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-leanpub"></i> <span>Pengajuan SKPI</span>
            </a>
        </li>
        <li>
            <a href="{{ route('skpi.list') }}" @if(Session::get('page')=='') style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-database"></i> <span>Data SKPI</span>
            </a>
        </li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-male"></i>
        <span>Alumni</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="{{ route('alumni.index') }}" @if(Session::get('page')=='indexAlumni' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-database"></i> <span>Data Alumni</span>
            </a>
            <a href="{{ route('masukan-alumni.index') }}" @if(Session::get('page')=='indexAlumni' ) style="background: #3c8dbc !important; color:white !important" @endif>
                <i class="fa fa-long-arrow-down"></i> <span>Saran & Masukan Alumni</span>
            </a>
        </li>
    </ul>
</li>