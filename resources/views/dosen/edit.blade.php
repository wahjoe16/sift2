@extends('layouts.master')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        Edit data user
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('dosen.update', $dosen->id) }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="nik" class="col-lg-2 col-lg-offset-1 control-label">NIK</label>
                            <div class="col-lg-6">
                                <input type="text" name="nik" id="nik" class="form-control" value="{{ $dosen->nik }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $dosen->nama }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="program_studi" class="col-lg-2 col-lg-offset-1 control-label">Program Studi</label>
                            <div class="col-lg-6">
                                <select name="program_studi" id="program_studi" class="form-control text-black">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "Teknik Pertambangan"=>"Teknik Pertambangan",
                                    "Teknik Industri"=>"Teknik Industri",
                                    "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                                    ] as $prodi => $prodiLabel)
                                    <option value="{{ $prodi }}" {{ old('program_studi', $dosen->program_studi)==$prodi ? "selected" : "" }}>{{ $prodiLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                            <div class="col-lg-6">
                                <input type="email" name="email" id="email" class="form-control" value="{{ $dosen->email }}" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-lg-2 col-lg-offset-1 control-label">Telepon</label>
                            <div class="col-lg-6">
                                <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $dosen->telepon }}" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_dekanat" class="col-lg-2 col-lg-offset-1 control-label">Status Dekanat</label>
                            <div class="col-lg-6">
                                <select name="status_dekanat" id="status_dekanat" class="form-control text-black">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "0"=>"Tidak",
                                    "1"=>"Ya"
                                    ] as $status => $statusLabel)
                                    <option value="{{ $status }}" {{ old('status_dekanat', $dosen->status_dekanat)==$status ? "selected" : "" }}>{{ $statusLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_kaprodi" class="col-lg-2 col-lg-offset-1 control-label">Status Ketua Program Studi</label>
                            <div class="col-lg-6">
                                <select name="status_kaprodi" id="status_kaprodi" class="form-control text-black">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "0"=>"Tidak",
                                    "1"=>"Ya"
                                    ] as $status => $statusLabel)
                                    <option value="{{ $status }}" {{ old('status_kaprodi', $dosen->status_kaprodi)==$status ? "selected" : "" }}>{{ $statusLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_sekprodi" class="col-lg-2 col-lg-offset-1 control-label">Status Sekertaris Program Studi</label>
                            <div class="col-lg-6">
                                <select name="status_sekprodi" id="status_sekprodi" class="form-control text-black">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "0"=>"Tidak",
                                    "1"=>"Ya"
                                    ] as $status => $statusLabel)
                                    <option value="{{ $status }}" {{ old('status_sekprodi', $dosen->status_sekprodi)==$status ? "selected" : "" }}>{{ $statusLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_koordinator_skripsi" class="col-lg-2 col-lg-offset-1 control-label">Status Koordinator Skripsi</label>
                            <div class="col-lg-6">
                                <select name="status_koordinator_skripsi" id="status_koordinator_skripsi" class="form-control text-black">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "0"=>"Tidak",
                                    "1"=>"Ya"
                                    ] as $status => $statusLabel)
                                    <option value="{{ $status }}" {{ old('status_koordinator_skripsi', $dosen->status_koordinator_skripsi)==$status ? "selected" : "" }}>{{ $statusLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection