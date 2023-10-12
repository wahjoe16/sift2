@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data Sidang Tugas Akhir</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Sidang Tugas Akhir</h3>
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
                            @if ($data->dosen_2 != '')
                            <b>{{ $data->dosen_2->nama }}</b>
                            @else
                            <b>-</b>
                            @endif
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
                            <p>Tanggal Approve</p>
                            <b>{{ tanggal_indonesia($data->updated_at) }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Status</p>
                            @if($data->status == 0)
                            <span class="label bg-yellow">Menunggu</span>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat01', $data->syarat_1) }}" target="_blank">Fotocopy Kwitansi Bimbingan TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat02', $data->syarat_2) }}" target="_blank">Fotocopy Kwitansi Sidang TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat03', $data->syarat_3) }}" target="_blank">Fotocopy Kwitansi Seminar TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat04', $data->syarat_4) }}" target="_blank">Fotocopy Sertifikat Pesantren Calon Sarjana</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat05', $data->syarat_5) }}" target="_blank">Formulir Rencana Studi (FRS)</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat06', $data->syarat_6) }}" target="_blank">Bukti Penyerahan Draft TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat07', $data->syarat_7) }}" target="_blank">Bukti Bebas Perpustakaan Pusat UNISBA</a>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat08', $data->syarat_8) }}" target="_blank">Bukti Bebas Perpustakaan TI</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat09', $data->syarat_9) }}" target="_blank">Transkrip Nilai Terakhir</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang/syarat10', $data->syarat_10) }}" target="_blank">Persetujuan Sidang dari Dosen Pembimbing</a></td>
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
                            <tr>
                                <td>11</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat11', $data->syarat_11) }}" target="_blank">Fotocopy Sertifikat TOEFL</a></td>
                                <td>
                                    @if($data->status_11 == '')
                                    -
                                    @elseif($data->status_11 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_11 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_11 != '')
                                    <p>{{ $data->keterangan_11 }}</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat12', $data->syarat_12) }}" target="_blank">Foto</a></td>
                                <td>
                                    @if($data->status_12 == '')
                                    -
                                    @elseif($data->status_12 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_12 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_12 != '')
                                    <p>{{ $data->keterangan_12 }}</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat13', $data->syarat_13) }}" target="_blank">Bukti Bebas Pinjaman / Tunggakan</a></td>
                                <td>
                                    @if($data->status_13 == '')
                                    -
                                    @elseif($data->status_13 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_13 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_13 != '')
                                    <p>{{ $data->keterangan_13 }}</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat14', $data->syarat_14) }}" target="_blank">Menghadiri Seminar / Sidang</a></td>
                                <td>
                                    @if($data->status_14 == '')
                                    -
                                    @elseif($data->status_14 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_14 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_14 != '')
                                    <p>{{ $data->keterangan_14 }}</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat15', $data->syarat_15) }}" target="_blank">Form Hafalan Surat Al-Quran</a></td>
                                <td>
                                    @if($data->status_15 == '')
                                    -
                                    @elseif($data->status_15 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_15 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_15 != '')
                                    <p>{{ $data->keterangan_15 }}</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat16', $data->syarat_16) }}" target="_blank">Print out bukti pengecekan Plagiarisme</a></td>
                                <td>
                                    @if($data->status_16 == '')
                                    -
                                    @elseif($data->status_16 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_16 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_16 != '')
                                    <p>{{ $data->keterangan_16 }}</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td><a href="{{ url('/mahasiswa/sidang/syarat17', $data->syarat_17) }}" target="_blank">Sertifikat SKKFT</a>
                                </td>
                                <td>
                                    @if($data->status_17 == '')
                                    -
                                    @elseif($data->status_17 == 1)
                                    <span class="label bg-green">Diterima</span>
                                    @elseif($data->status_17 == 2)
                                    <span class="label bg-red">Ditolak</span>
                                    @else
                                    <span class="label bg-yellow text-black">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->keterangan_17 != '')
                                    <p>{{ $data->keterangan_17 }}</p>
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
                        <a href="{{ route('sidang_ti.edit', $data->id) }}" class="btn btn-warning btn-flat">Perbaiki</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('sidang_ti.index') }}" class="btn btn-primary btn-flat">Kembali</a>
        </div>
    </div>
</section>

@endsection