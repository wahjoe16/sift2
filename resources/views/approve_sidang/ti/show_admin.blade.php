@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Sidang Tugas Akhir {{ $data->mahasiswa->nama }}</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Sidang Tugas Akhir</h3>
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
                            <p>Pembimbing</p>
                            <b>{{ $data->dosen_1->nama }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Co. Pembimbing</p>
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
                            @if ($data->status == 0)
                            <b>-</b>
                            @else
                            <b>{{ tanggal_indonesia($data->updated_at) }}</b>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_1) }}" target="_blank">Fotocopy Kwitansi Bimbingan TA</a></td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_2) }}" target="_blank">Fotocopy Kwitansi Sidang TA</a></td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_3) }}" target="_blank">Fotocopy Kwitansi Seminar TA</a></td>

                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_4) }}" target="_blank">Fotocopy Sertifikat Pesantren Calon Sarjana</a>
                                </td>

                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_5) }}" target="_blank">Formulir Rencana Studi (FRS)</a></td>

                            </tr>
                            <tr>
                                <td>6</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_6) }}" target="_blank">Bukti Penyerahan Draft TA (4 Eksemplar)</a></td>

                            </tr>
                            <tr>
                                <td>7</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_7) }}" target="_blank">Bukti Bebas Perpustakaan Pusat UNISBA</a></td>

                            </tr>
                            <tr>
                                <td>8</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_8) }}" target="_blank">Bukti Bebas Perpustakaan TI</a></td>

                            </tr>
                            <tr>
                                <td>9</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_9) }}" target="_blank">Transkrip Nilai Terakhir</a></td>

                            </tr>
                            <tr>
                                <td>10</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_10) }}" target="_blank">Persetujuan Sidang dari Dosen Pembimbing (Kartu Bimbingan Asli)</a></td>

                            </tr>
                            <tr>
                                <td>11</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_11) }}" target="_blank">Fotocopy Sertifikat TOEFL</a></td>

                            </tr>
                            <tr>
                                <td>12</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_12) }}" target="_blank">Foto Berwarna</a></td>

                            </tr>
                            <tr>
                                <td>13</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_13) }}" target="_blank">Bebas Pinjaman / Tunggakan</a></td>

                            </tr>
                            <tr>
                                <td>14</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_14) }}" target="_blank">Menghadiri Seminar / Sidang minimal 3 kali</a>
                                </td>

                            </tr>
                            <tr>
                                <td>15</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_15) }}" target="_blank">Form Hafalan Surat Al-Quran (minimal 25 surat)</a></td>

                            </tr>
                            <tr>
                                <td>16</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_16) }}" target="_blank">Print out bukti pengecekan Plagiarisme < 25% (sebelum sidang)</a>
                                </td>

                            </tr>
                            <tr>
                                <td>17</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_17) }}" target="_blank">Sertifikat SKKFT yang ditandatangani oleh Wadek III</a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection