@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Approval Sidang Skripsi</h3>
    </div>
</div>

@include('layouts.alert')

<form action="{{ route('approve-sidangTmb.store', $data->id) }}" class="form-horizontal" method="post">@csrf
    <div class="row">
        <div class="col-md-4">
            <div class="card card-post card-round">
                <img class="card-img-top" src="{{ asset('/media/unisba.JPG') }}" alt="Card image cap" />
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('/user/foto/' . $data->mahasiswa->foto) }}" alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <div class="info-post ms-2">
                            <p class="username">{{ $data->mahasiswa->nama }}</p>
                            <p class="date text-muted">{{ $data->mahasiswa->nik }}</p>
                        </div>
                    </div>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Tahun Akademik</h3>
                    <p class="card-text">{{ $data->tahun_ajaran->tahun_ajaran }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Semester</h3>
                    <p class="card-text">{{ $data->semester->semester }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Pembimbing</h3>
                    <p class="card-text">{{ $data->dosen_1->nama }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Co. Pembimbing</h3>
                    @if ($data->dosen_2 != '')
                    <p class="card-text">{{ $data->dosen_2->nama }}</p>
                    @else
                    <p class="card-text">-</p>
                    @endif

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Judul Skripsi</h3>
                    <p class="card-text">{{ $data->judul_skripsi }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Tanggal Pengajuan</h3>
                    <p class="card-text">{{ tanggal_indonesia($data->created_at) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Dokumen Persyaratan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dokumen</th>
                                <th><i class="fas fa-thumbs-down text-danger"></i></th>
                                <th><i class="fas fa-thumbs-up text-success"></i></th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_1) }}" target="_blank">Transkrip Nilai Terakhir</a></td>
                                <td>
                                    @if ($data->status_1 == 2)
                                    <input type="radio" name="status_1" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_1 == 0)
                                    <input type="radio" name="status_1" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_1 == 1)
                                    <input type="radio" name="status_1" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_1 == 0)
                                    <input type="radio" name="status_1" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_1" id="keterangan_1" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_2) }}" target="_blank">Sertifikat Pesantren Calon Sarjana</a></td>
                                <td>
                                    @if ($data->status_2 == 2)
                                    <input type="radio" name="status_2" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_2 == 0)
                                    <input type="radio" name="status_2" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_2 == 1)
                                    <input type="radio" name="status_2" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_2 == 0)
                                    <input type="radio" name="status_2" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_2" id="keterangan_2" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_3) }}" target="_blank">Sertifikat SKKFT</a></td>
                                <td>
                                    @if ($data->status_3 == 2)
                                    <input type="radio" name="status_3" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_3 == 0)
                                    <input type="radio" name="status_3" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_3 == 1)
                                    <input type="radio" name="status_3" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_3 == 0)
                                    <input type="radio" name="status_3" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_3" id="keterangan_3" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_4) }}" target="_blank">Bukti Pembayaran Sidang Skripsi</a></td>
                                <td>
                                    @if ($data->status_4 == 2)
                                    <input type="radio" name="status_4" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_4 == 0)
                                    <input type="radio" name="status_4" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_4 == 1)
                                    <input type="radio" name="status_4" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_4 == 0)
                                    <input type="radio" name="status_4" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_4" id="keterangan_4" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_5) }}" target="_blank">Sertifikat TOEFL</a></td>
                                <td>
                                    @if ($data->status_5 == 2)
                                    <input type="radio" name="status_5" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_5 == 0)
                                    <input type="radio" name="status_5" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_5 == 1)
                                    <input type="radio" name="status_5" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_5 == 0)
                                    <input type="radio" name="status_5" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_5" id="keterangan_5" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-info btn-flat mr-2">Simpan</button>
            <a href="{{ route('view-sidangTmb.index') }}" class="btn btn-light">Batal</a>
        </div>
    </div>
</form>

@endsection