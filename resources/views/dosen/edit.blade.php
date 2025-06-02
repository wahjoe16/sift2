@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Edit User (Dosen)</h3>
    </div>
</div>

<form action="{{ route('dosen.update', $dosen->id) }}" method="post">@csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Profile</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama"><strong>Nama Dosen</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-user"></i></span>
                            <input type="text" name="nama" id="nama" required class="form-control" value="{{ $dosen->nama }}" placeholder="Nama" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nik"><strong>NIK</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-tag"></i></span>
                            <input type="text" name="nik" id="nik" required class="form-control" value="{{ $dosen->nik }}" placeholder="NIK" aria-label="Username" aria-describedby="basic-addon1"/>
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
                                    <option value="{{ $prodi }}" {{ old('program_studi', $dosen->program_studi)==$prodi ? "selected" : "" }}>{{ $prodiLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $dosen->email }}" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telepon"><strong>Telepon</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-screen-smartphone"></i></span>
                            <input type="telepon" name="telepon" id="telepon" class="form-control" value="{{ $dosen->telepon }}" placeholder="Telepon" aria-label="Username" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Akademik & Jabatan</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="class_pendidikan"><strong>Pendidikan</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-graduation"></i></span>
                            <select name="class_pendidikan" id="class_pendidikan" class="form-select form-control" id="largeSelect" >
                                <option value="">Select</option>
                                @foreach ([
                                "S2"=>"S2",
                                "S3"=>"S3"
                                ] as $pendidikan => $pendidikanLabel)
                                <option value="{{ $pendidikan }}" {{ old('class_pendidikan', $dosen->class_pendidikan)==$pendidikan ? "selected" : "" }}>{{ $pendidikanLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class_jabfung"><strong>Jabatan Fungsional</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-shield"></i></span>
                            <select name="class_jabfung" id="class_jabfung" class="form-select form-control" id="largeSelect" >
                                <option value="">Select</option>
                                @foreach ([
                                "Tenaga Pengajar"=>"Tenaga Pengajar",
                                "Asisten Ahli"=>"Asisten Ahli",
                                "Lektor"=>"Lektor",
                                "Lektor Kepala"=>"Lektor Kepala",
                                "Guru Besar/Professor"=>"Guru Besar/Professor"
                                ] as $jabfung => $jabfungLabel)
                                <option value="{{ $jabfung }}" {{ old('class_jabfung', $dosen->class_jabfung)==$jabfung ? "selected" : "" }}>{{ $jabfungLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelompok_keahlian"><strong>Kelompok Keahlian</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-wrench"></i></span>
                            <select name="kelompok_keahlian" id="" class="form-select form-control" id="largeSelect">
                                <option value="">Select</option>
                                    <optgroup label="Teknik Pertambangan">
                                        @foreach ([
                                            "Geologi Eksplorasi"=>"Geologi Eksplorasi", 
                                            "Tambang Umum"=>"Tambang Umum", 
                                            "Pengolahan Bahan Galian"=>"Pengolahan Bahan Galian"
                                        ] as $kelompok_keahlian_tmb=>$kelompok_keahlian_tmbLabel)
                                        <option value="{{ $kelompok_keahlian_tmb }}" {{ old('kelompok_keahlian', $dosen->kelompok_keahlian)==$kelompok_keahlian_tmb ? "selected" : "" }}>{{ $kelompok_keahlian_tmbLabel }}</option>
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Teknik Industri">
                                        @foreach ([
                                            "Keahlian Ergonomi dan Rekayasa Kerja"=>"Keahlian Ergonomi dan Rekayasa Kerja", 
                                            "Manajemen Industri"=>"Manajemen Industri", 
                                            "Sistem Industri dan Tekno-Ekonomi"=>"Sistem Industri dan Tekno-Ekonomi",
                                            "Sistem Manufaktur"=>"Sistem Manufaktur"
                                        ] as $kelompok_keahlian_ti=>$kelompok_keahlian_tiLabel)
                                        <option value="{{ $kelompok_keahlian_ti }}" {{ old('kelompok_keahlian', $dosen->kelompok_keahlian)==$kelompok_keahlian_ti ? "selected" : "" }}>{{ $kelompok_keahlian_tiLabel }}</option>
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Perencanaan Wilayah dan Kota">
                                        @foreach ([
                                            "Kota"=>"Kota", 
                                            "Transportasi"=>"Transportasi", 
                                            "Lingkungan"=>"Lingkungan",
                                            "Pariwisata"=>"Pariwisata",
                                            "Rekayasa Pedesaan"=>"Rekayasa Pedesaan"
                                        ] as $kelompok_keahlian_pwk=>$kelompok_keahlian_pwkLabel)
                                        <option value="{{ $kelompok_keahlian_pwk }}" {{ old('kelompok_keahlian', $dosen->kelompok_keahlian)==$kelompok_keahlian_pwk ? "selected" : "" }}>{{ $kelompok_keahlian_pwkLabel }}</option>
                                        @endforeach
                                    </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_dekanat"><strong>Status Dekanat</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-badge"></i></span>
                            <select name="status_dekanat" id="status_dekanat" class="form-select form-control" id="largeSelect" >
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
                    <div class="form-group">
                        <label for="status_kaprodi"><strong>Status Ketua Program Studi</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-badge"></i></span>
                            <select name="status_kaprodi" id="status_kaprodi" class="form-select form-control" id="largeSelect" >
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
                    <div class="form-group">
                        <label for="status_sekprodi"><strong>Status Sekertaris Program Studi</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-badge"></i></span>
                            <select name="status_sekprodi" id="status_sekprodi" class="form-select form-control" id="largeSelect" >
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
                    <div class="form-group">
                        <label for="status_koordinator_skripsi"><strong>Status Koordinator Skripsi / Tugas Akhir</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="icon-badge"></i></span>
                            <select name="status_koordinator_skripsi" id="status_koordinator_skripsi" class="form-select form-control" id="largeSelect" >
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('dosen.index') }}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>

@endsection