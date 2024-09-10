<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="small-box bg-green">
        <div class="inner">
            <h3>Arsip</h3>

            <p>Fakultas Teknik</p>
        </div>
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        <a href="{{ route('ft-arsip.index') }}" class="small-box-footer">
            Klik Disini <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="small-box bg-maroon">
        <div class="inner">
            <h3>Alumni</h3>

            <p>Database Alumni Fakultas Teknik</p>
        </div>
        <div class="icon">
            <i class="fa fa-male"></i>
        </div>
        <a href="{{ route('alumni.index') }}" class="small-box-footer">
            Klik Disini <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="small-box bg-red">
        <div class="inner">
            <h3>SKKFT</h3>

            <p>Satuan Kegiatan Kemahasiswaan Fakultas Teknik</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        @if (auth()->user()->status_superadmin == 1)
           <a href="{{ route('dashboardSkkft.index') }}" class="small-box-footer">
                Klik Disini <i class="fa fa-arrow-circle-right"></i>
            </a>
        @elseif (auth()->user()->status_superadmin == 0)
            <a href="{{ route('dataSkkft.index') }}" class="small-box-footer">
                Klik Disini <i class="fa fa-arrow-circle-right"></i>
            </a> 
        @endif
        
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3>SKPI</h3>

            <p>Surat Keterangan Pendamping Ijazah</p>
        </div>
        <div class="icon">
            <i class="fa fa-newspaper-o"></i>
        </div>
        <a href="{{ route('skpi.list') }}" class="small-box-footer">
            Klik Disini <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>