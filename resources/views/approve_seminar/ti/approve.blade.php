@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Approval Seminar Tugas Akhir</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <form action="{{ route('approve-seminarTi.store', $data->id) }}" class="form-horizontal" method="post">@csrf
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Seminar Tugas Akhir</h3>
                    </div>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $data->mahasiswa->foto) }}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{ $data->mahasiswa->nama }}</h3>
                        <p class="text-muted text-center">{{ $data->mahasiswa->nik }}</p>
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
                                    <th><i class="fa fa-close text-red"></i></th>
                                    <th><i class="fa fa-check text-green"></i></th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat01', $data->syarat_1) }}" target="_blank">Formulir pendaftaran Seminar terisi</a></td>
                                    <td>
                                        @if ($data->status_1 == 2)
                                        <input type="radio" name="status_1" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_1 == 0)
                                        <input type="radio" name="status_1" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_1 == 1)
                                        <input type="radio" name="status_1" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_1 == 0)
                                        <input type="radio" name="status_1" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_1" id="keterangan_1" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat02', $data->syarat_2) }}" target="_blank">Copy Berita Acara Pembimbingan / Kartu Bimbingan</a></td>
                                    <td>
                                        @if ($data->status_2 == 2)
                                        <input type="radio" name="status_2" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_2 == 0)
                                        <input type="radio" name="status_2" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_2 == 1)
                                        <input type="radio" name="status_2" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_2 == 0)
                                        <input type="radio" name="status_2" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_2" id="keterangan_2" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat03', $data->syarat_3) }}" target="_blank">Persetujuan Seminar dari Dosen Pembimbing</a></td>
                                    <td>
                                        @if ($data->status_3 == 2)
                                        <input type="radio" name="status_3" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_3 == 0)
                                        <input type="radio" name="status_3" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_3 == 1)
                                        <input type="radio" name="status_3" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_3 == 0)
                                        <input type="radio" name="status_3" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_3" id="keterangan_3" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat04', $data->syarat_4) }}" target="_blank">Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir</a></td>
                                    <td>
                                        @if ($data->status_4 == 2)
                                        <input type="radio" name="status_4" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_4 == 0)
                                        <input type="radio" name="status_4" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_4 == 1)
                                        <input type="radio" name="status_4" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_4 == 0)
                                        <input type="radio" name="status_4" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_4" id="keterangan_4" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat05', $data->syarat_5) }}" target="_blank">Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP</a></td>
                                    <td>
                                        @if ($data->status_5 == 2)
                                        <input type="radio" name="status_5" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_5 == 0)
                                        <input type="radio" name="status_5" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_5 == 1)
                                        <input type="radio" name="status_5" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_5 == 0)
                                        <input type="radio" name="status_5" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_5" id="keterangan_5" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat06', $data->syarat_6) }}" target="_blank">Form Bebas Tunggakan / Pinjaman</a></td>
                                    <td>
                                        @if ($data->status_6 == 2)
                                        <input type="radio" name="status_6" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_6 == 0)
                                        <input type="radio" name="status_6" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_6 == 1)
                                        <input type="radio" name="status_6" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_6 == 0)
                                        <input type="radio" name="status_6" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_6" id="keterangan_6" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat07', $data->syarat_7) }}" target="_blank">Print out bukti pengecekan Plagiarisme <= 25%</a>
                                    </td>
                                    <td>
                                        @if ($data->status_7 == 2)
                                        <input type="radio" name="status_7" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_7 == 0)
                                        <input type="radio" name="status_7" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_7 == 1)
                                        <input type="radio" name="status_7" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_7 == 0)
                                        <input type="radio" name="status_7" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_7" id="keterangan_7" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat08', $data->syarat_8) }}" target="_blank">Bukti Monitoring Hafalan</a></td>
                                    <td>
                                        @if ($data->status_8 == 2)
                                        <input type="radio" name="status_8" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_8 == 0)
                                        <input type="radio" name="status_8" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_8 == 1)
                                        <input type="radio" name="status_8" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_8 == 0)
                                        <input type="radio" name="status_8" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_8" id="keterangan_8" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat09', $data->syarat_9) }}" target="_blank">Sertifikat SKKFT</a></td>
                                    <td>
                                        @if ($data->status_9 == 2)
                                        <input type="radio" name="status_9" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_9 == 0)
                                        <input type="radio" name="status_9" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_9 == 1)
                                        <input type="radio" name="status_9" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_9 == 0)
                                        <input type="radio" name="status_9" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_9" id="keterangan_9" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td><a href="{{ url('/mahasiswa/seminar/syarat10', $data->syarat_10) }}" target="_blank">Surat Penunjukan Pembimbing</a></td>
                                    <td>
                                        @if ($data->status_10 == 2)
                                        <input type="radio" name="status_10" value="2" class="minimal-red" checked="checked" readonly>
                                        @elseif ($data->status_10 == 0)
                                        <input type="radio" name="status_10" value="2" class="minimal-red">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status_10 == 1)
                                        <input type="radio" name="status_10" value="1" class="flat-red" checked="checked" readonly>
                                        @elseif ($data->status_10 == 0)
                                        <input type="radio" name="status_10" value="1" class="flat-red">
                                        @endif
                                    </td>
                                    <td>
                                        <textarea name="keterangan_10" id="keterangan_10" cols="30" rows="1" class="form-control"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-info btn-flat mr-2">Simpan</button>
                <a href="{{ route('view-seminarTi.index') }}" class="btn btn-light">Batal</a>
            </div>
            <div class="col-sm-10">

            </div>
        </div>
    </form>
</section>

@endsection