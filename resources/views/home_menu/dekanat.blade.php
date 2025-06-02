<div class="col-sm-6 col-md-3">
    <a href="{{ route('sertifikat.index') }}" class="small-box-footer">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="icon-energy text-success"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Kegiatan Kemahasiswaan</p>
                            <h4 class="card-title">SKKFT</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-sm-6 col-md-3">
    <a href="{{ route('skpi.index') }}" class="small-box-footer">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="icon-docs text-info"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Pendamping Ijazah</p>
                            <h4 class="card-title">SKPI</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-sm-6 col-md-3">
    <a href="{{ route('alumni.index') }}" class="small-box-footer">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="icon-people text-primary"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Database Alumni Fakultas</p>
                            <h4 class="card-title">{{ $alumni }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
