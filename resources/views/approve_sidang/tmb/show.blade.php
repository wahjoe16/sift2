@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data Kolokium Skripsi {{ $data->mahasiswa->nama }}</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Kolokium Skripsi</h3>
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
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Dokumen Persyaratan</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat01', $data->syarat_1) }}" target="_blank">Bukti pembayaran Kolokium Skripsi</a></td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat02', $data->syarat_2) }}" target="_blank">Sertifikat TOEFL</a></td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat03', $data->syarat_3) }}" target="_blank">Formulir nilai bimbingan skripsi</a></td>

                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat04', $data->syarat_4) }}" target="_blank">Formulir kemajuan bimbingan skripsi</a></td>

                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat05', $data->syarat_5) }}" target="_blank">Formulir persetujuan kolokium skripsi</a></td>

                            </tr>
                            <tr>
                                <td>6</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat06', $data->syarat_6) }}" target="_blank">Formulir kesediaan menghadiri kolokium skripsi</a></td>

                            </tr>
                            <tr>
                                <td>7</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat07', $data->syarat_7) }}" target="_blank">Pas foto ukuran 4 x 6 sebanyak 2 lembar</a></td>

                            </tr>
                            <tr>
                                <td>8</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat08', $data->syarat_8) }}" target="_blank">Kartu Tanda Mahasiswa</a></td>

                            </tr>
                            <tr>
                                <td>9</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat09', $data->syarat_9) }}" target="_blank">Bukti pembayaran kuliah</a></td>

                            </tr>
                            <tr>
                                <td>10</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat10', $data->syarat_10) }}" target="_blank">Bukti perwalian</a></td>

                            </tr>
                            <tr>
                                <td>11</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat11', $data->syarat_11) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></td>

                            </tr>
                            <tr>
                                <td>12</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat12', $data->syarat_12) }}" target="_blank">Keterangan menghadiri kolokium skripsi (7 kali)</a></td>

                            </tr>
                            <tr>
                                <td>13</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat13', $data->syarat_13) }}" target="_blank">Draft skripsi (PDF)</a></td>

                            </tr>
                            <tr>
                                <td>14</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat14', $data->syarat_14) }}" target="_blank">Draft skripsi (DOCX)</a></td>

                            </tr>
                            <tr>
                                <td>15</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat15', $data->syarat_15) }}" target="_blank">Sertifikat SKKFT</a></td>

                            </tr>
                            <tr>
                                <td>16</td>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat16', $data->syarat_16) }}" target="_blank">Bukti pembayaran Kolokium Skripsi</a></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection