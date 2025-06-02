@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Edit User (Mahasiswa)</h3>
    </div>
</div>

<form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">@csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Profile</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama"><strong>Nama Mahasiswa</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-user"></i></span>
                            <input type="text" name="nama" id="nama" required class="form-control" value="{{ $mahasiswa->nama }}" placeholder="Nama" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nik"><strong>NPM</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-tag"></i></span>
                            <input type="text" name="nik" id="nik" required class="form-control" value="{{ $mahasiswa->nik }}" placeholder="NIK" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="program_studi"><strong>Program Studi</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-screen-desktop"></i></span>
                            <select name="program_studi" id="program_studi" class="form-select form-control" id="largeSelect" >
                                <option value="">Select</option>
                                @foreach ([
                                    "Teknik Pertambangan"=>"Teknik Pertambangan",
                                    "Teknik Industri"=>"Teknik Industri",
                                    "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                                    "Program Profesi Insinyur"=>"Program Profesi Insinyur",
                                    "Magister Perencanaan Wilayah dan Kota"=>"Magister Perencanaan Wilayah dan Kota"
                                    ] as $prodi => $prodiLabel)
                                    <option value="{{ $prodi }}" {{ old('program_studi', $mahasiswa->program_studi)==$prodi ? "selected" : "" }}>{{ $prodiLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $mahasiswa->email }}" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telepon"><strong>Telepon</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-screen-smartphone"></i></span>
                            <input type="telepon" name="telepon" id="telepon" class="form-control" value="{{ $mahasiswa->telepon }}" placeholder="Telepon" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>

@endsection