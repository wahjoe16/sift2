@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Data Sidang Pembahasan</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Informasi Kolokium Skripsi</h5>
            </div>
            <div class="card-body">
                <h6 class="card-title">Tahun Akademik</h6>
                <p class="card-text">{{ $data->tahun_ajaran->tahun_ajaran }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Semester</h6>
                <p class="card-text">{{ $data->semester->semester }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Pembimbing 1</h6>
                <p class="card-text">{{ $data->dosen_1->nama }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Pembimbing 2</h6>
                @if ($data->dosen_2 != '')
                <p class="card-text">{{ $data->dosen_2->nama }}</p>
                @else
                <p class="card-text">-</p>
                @endif

                <div class="separator-solid"></div>
                <h6 class="card-title">Judul Skripsi</h6>
                <p class="card-text">{{ $data->judul_skripsi }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Tanggal Pengajuan</h6>
                <p class="card-text">{{ tanggal_indonesia($data->created_at) }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Status</h6>
                @if($data->status == 0)
                <span class="badge badge-warning text-black">Menunggu</span>
                @elseif($data->status == 1)
                <span class="badge badge-success">Diterima</span>
                @elseif($data->status == 2)
                <span class="badge badge-danger">Ditolak</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Dokumen Persyaratan</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->syarat_1 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_1) }}" target="_blank">Lembar bimbingan skripsi</a></td>
                            <td>
                                @if($data->status_1 == '')
                                -
                                @elseif($data->status_1 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_1 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_1 != '')
                                <p>{{ $data->keterangan_1 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_2 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_2) }}" target="_blank">Sertifikat pesantren mahasiswa baru</a></td>
                            <td>
                                @if($data->status_2 == '')
                                -
                                @elseif($data->status_2 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_2 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_2 != '')
                                <p>{{ $data->keterangan_2 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_3 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_3) }}" target="_blank">Sertifikat pesantren calon sarjana</a></td>
                            <td>
                                @if($data->status_3 == '')
                                -
                                @elseif($data->status_3 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_3 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_3 != '')
                                <p>{{ $data->keterangan_3 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_4 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_4) }}" target="_blank">Transkrip nilai</a></td>
                            <td>
                                @if($data->status_4 == '')
                                -
                                @elseif($data->status_4 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_4 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_4 != '')
                                <p>{{ $data->keterangan_4 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_5 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_5) }}" target="_blank">Sertifikat TOEFL</a></td>
                            <td>
                                @if($data->status_5 == '')
                                -
                                @elseif($data->status_5 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_5 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_5 != '')
                                <p>{{ $data->keterangan_5 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_6 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_6) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></td>
                            <td>
                                @if($data->status_6 == '')
                                -
                                @elseif($data->status_6 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_6 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_6 != '')
                                <p>{{ $data->keterangan_6 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_7 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_7) }}" target="_blank">Sertifikat SKKFT</a>
                            </td>
                            <td>
                                @if($data->status_7 == '')
                                -
                                @elseif($data->status_7 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_7 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_7 != '')
                                <p>{{ $data->keterangan_7 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_8 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_8) }}" target="_blank">Bukti KRS (pengambilan MK. Skripsi)</a></td>
                            <td>
                                @if($data->status_8 == '')
                                -
                                @elseif($data->status_8 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_8 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_8 != '')
                                <p>{{ $data->keterangan_8 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_9 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_9) }}" target="_blank">Bukti pembayaran DPP Mk. Skripsi</a></td>
                            <td>
                                @if($data->status_9 == '')
                                -
                                @elseif($data->status_9 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_9 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_9 != '')
                                <p>{{ $data->keterangan_9 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if ($data->syarat_10 != '')
                        <tr>
                            <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_10) }}" target="_blank">Bukti pembayaran sidang pembahasan</a></td>
                            <td>
                                @if($data->status_10 == '')
                                -
                                @elseif($data->status_10 == 1)
                                <span class="badge badge-success">Diterima</span>
                                @elseif($data->status_10 == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-warning text-black">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan_10 != '')
                                <p>{{ $data->keterangan_10 }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @if ($data->status == 2)
                <div class="card-footer">
                    <div class="btn-group">
                        <a href="{{ route('seminar_pwk.edit', $data->id) }}" class="btn btn-warning">Perbaiki</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('seminar_pwk.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>

@endsection