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
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="nik" class="col-lg-2 col-lg-offset-1 control-label">NPM</label>
                            <div class="col-lg-6">
                                <input type="text" name="nik" id="nik" class="form-control" value="{{ $mahasiswa->nik }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $mahasiswa->nama }}" required autofocus>
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
                                    <option value="{{ $prodi }}" {{ old('program_studi', $mahasiswa->program_studi)==$prodi ? "selected" : "" }}>{{ $prodiLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                            <div class="col-lg-6">
                                <input type="email" name="email" id="email" class="form-control" value="{{ $mahasiswa->email }}" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-lg-2 col-lg-offset-1 control-label">Telepon</label>
                            <div class="col-lg-6">
                                <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $mahasiswa->telepon }}" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection