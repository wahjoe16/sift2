@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data Seminar Tugas Akhir</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Seminar Tugas Akhir</h3>
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dokumen Persyaratan</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat01', $data->syarat_1) }}" target="_blank">Formulir pendaftaran Seminar terisi</a></td>
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
                            <tr>
                                <td>2</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat02', $data->syarat_2) }}" target="_blank">Copy Berita Acara Pembimbingan / Kartu Bimbingan</a></td>
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
                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat03', $data->syarat_3) }}" target="_blank">Persetujuan Seminar dari Dosen Pembimbing</a></td>
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
                            <tr>
                                <td>4</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat04', $data->syarat_4) }}" target="_blank">Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir</a></td>
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
                            <tr>
                                <td>5</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat05', $data->syarat_5) }}" target="_blank">Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP</a></td>
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
                            <tr>
                                <td>6</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat06', $data->syarat_6) }}" target="_blank">Form Bebas Tunggakan / Pinjaman</a></td>
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
                            <tr>
                                <td>7</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat07', $data->syarat_7) }}" target="_blank">Print out bukti pengecekan Plagiarisme <= 25%</a>
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
                            <tr>
                                <td>8</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat08', $data->syarat_8) }}" target="_blank">Bukti Monitoring Hafalan</a></td>
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
                            <tr>
                                <td>9</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat09', $data->syarat_9) }}" target="_blank">Sertifikat SKKFT</a></td>
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
                            <tr>
                                <td>10</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat10', $data->syarat_10) }}" target="_blank">Bukti perwalian</a></td>
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
                        </tbody>
                    </table>
                </div>
                @if ($data->status == 2)
                <div class="box-footer with-border">
                    <div class="btn-group">
                        <a href="{{ route('seminar_ti.edit', $data->id) }}" class="btn btn-warning btn-flat">Perbaiki</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('seminar_ti.index') }}" class="btn btn-primary btn-flat">Kembali</a>
        </div>
    </div>
</section>

@endsection