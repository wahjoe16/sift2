@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data Sidang Pembahasan</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Sidang Pembahasan</h3>
                </div>
                <div class="box-body box-profile">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p>Tahun Akademik</p>
                            <b>{{ $data->tahun_ajaran->tahun_ajaran }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Semester</p>
                            <b>{{ $data->semester->semester }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Dosen Pembimbing 1</p>
                            <b>{{ $data->dosen_1->nama }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Dosen Pembimbing 2</p>
                            <b>{{ $data->dosen_2->nama }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Judul Skripsi</p>
                            <b>{{ $data->judul_skripsi }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Tanggal Pengajuan</p>
                            <b>{{ tanggal_indonesia($data->created_at) }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Status</p>
                            @if($data->status == 0)
                            <span class="label bg-yellow text-black">Menunggu</span>
                            @elseif($data->status == 1)
                            <span class="label bg-green">Diterima</span>
                            @elseif($data->status == 2)
                            <span class="label bg-red">Ditolak</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Dokumen Persyaratan</h3>
                </div>
                <div class="box-body no-padding">
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat01', $data->syarat_1) }}" target="_blank">Lembar bimbingan skripsi</a></td>
                                <td>
                                    @if($data->status_1 == '')
                                    -
                                    @elseif($data->status_1 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_1 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat02', $data->syarat_2) }}" target="_blank">Sertifikat pesantren mahasiswa baru</a></td>
                                <td>
                                    @if($data->status_2 == '')
                                    -
                                    @elseif($data->status_2 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_2 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat03', $data->syarat_3) }}" target="_blank">Sertifikat pesantren calon sarjana</a></td>
                                <td>
                                    @if($data->status_3 == '')
                                    -
                                    @elseif($data->status_3 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_3 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat04', $data->syarat_4) }}" target="_blank">Transkrip nilai</a></td>
                                <td>
                                    @if($data->status_4 == '')
                                    -
                                    @elseif($data->status_4 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_4 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat05', $data->syarat_5) }}" target="_blank">Sertifikat TOEFL</a></td>
                                <td>
                                    @if($data->status_5 == '')
                                    -
                                    @elseif($data->status_5 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_5 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat06', $data->syarat_6) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></td>
                                <td>
                                    @if($data->status_6 == '')
                                    -
                                    @elseif($data->status_6 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_6 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat07', $data->syarat_7) }}" target="_blank">Sertifikat SKKFT</a>
                                </td>
                                <td>
                                    @if($data->status_7 == '')
                                    -
                                    @elseif($data->status_7 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_7 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat08', $data->syarat_8) }}" target="_blank">Bukti KRS (pengambilan MK. Skripsi)</a></td>
                                <td>
                                    @if($data->status_8 == '')
                                    -
                                    @elseif($data->status_8 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_8 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat09', $data->syarat_9) }}" target="_blank">Bukti pembayaran DPP Mk. Skripsi</a></td>
                                <td>
                                    @if($data->status_9 == '')
                                    -
                                    @elseif($data->status_9 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_9 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/seminar/syarat10', $data->syarat_10) }}" target="_blank">Bukti pembayaran sidang pembahasan</a></td>
                                <td>
                                    @if($data->status_10 == '')
                                    -
                                    @elseif($data->status_10 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_10 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
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
                <div class="box-footer with-border">
                    <div class="btn-group">
                        <a href="{{ route('seminar_pwk.edit', $data->id) }}" class="btn btn-warning btn-flat">Perbaiki</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('seminar_pwk.index') }}" class="btn btn-primary btn-flat">Kembali</a>
        </div>
    </div>
</section>

@endsection