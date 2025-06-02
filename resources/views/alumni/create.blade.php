@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Alumni Fakultas Teknik</h3>
    </div>
</div>

<form action="{{ route('alumni.store') }}" method="post">@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Alumni</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="nik">NPM</label>
                        <input type="text" name="nik" id="nik" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="program_studi">Program Studi</label>
                        <select name="program_studi" id="program_studi" class="form-control text-black" required>
                            <option value="">Select</option>
                            @foreach ([
                            "Teknik Pertambangan"=>"Teknik Pertambangan",
                            "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                            "Teknik Industri"=>"Teknik Industri"
                            ] as $programStudi => $prodiLabel)
                            <option value="{{ $programStudi }}">{{ $prodiLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Data Pekerjaan</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="pekerjaan_sekarang">Pekerjaan Sekarang</label>
                        
                            <input type="text" name="pekerjaan_sekarang" id="pekerjaan_sekarang" class="form-control" autofocus>
                            <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="perusahaan_sekarang">Perusahaan Sekarang</label>
                        
                            <input type="text" name="perusahaan_sekarang" id="perusahaan_sekarang" class="form-control" autofocus>
                            <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kerja">Alamat Perusahaan</label>
                        
                            <input type="text" name="alamat_kerja" id="alamat_kerja" class="form-control" autofocus>
                            <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="form-group">
        <div class="col-lg-6">
            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>
@endsection
