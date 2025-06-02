@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Data Sidang Tugas Akhir {{ $dataSidang->mahasiswa->nama }}</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-post card-round">
            <img class="card-img-top" src="{{ asset('/media/unisba.JPG') }}" alt="Card image cap" />
            <div class="card-body">
                <div class="d-flex">
                    <div class="avatar avatar-xl">
                        <img src="{{ asset('/user/foto/' . $dataSidang->mahasiswa->foto) }}" alt="..." class="avatar-img rounded-circle" />
                    </div>
                    <div class="info-post ms-2">
                        <p class="username">{{ $dataSidang->mahasiswa->nama }}</p>
                        <p class="date text-muted">{{ $dataSidang->mahasiswa->nik }}</p>
                    </div>
                </div>

                <div class="separator-solid"></div>
                <h3 class="card-title">Program Studi</h3>
                <p class="card-text">{{ $dataSidang->mahasiswa->program_studi }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Email</h3>
                <p class="card-text">{{ $dataSidang->mahasiswa->email }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tahun Akademik</h3>
                <p class="card-text">{{ $dataSidang->tahun_ajaran->tahun_ajaran }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Semester</h3>
                <p class="card-text">{{ $dataSidang->semester->semester }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Pembimbing 1</h3>
                <p class="card-text">{{ $dataSidang->dosen_1->nama }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Pembimbing 2</h3>
                @if ($dataSidang->dosen_2 != '')
                <p class="card-text">{{ $dataSidang->dosen_2->nama }}</p>
                @else
                <p class="card-text">-</p>
                @endif         
                
                <div class="separator-solid"></div>
                <h3 class="card-title">Judul Tugas Akhir</h3>
                <p class="card-text">{{ $dataSidang->judul_skripsi }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tanggal Pengajuan</h3>
                <p class="card-text">{{ tanggal_indonesia($dataSidang->created_at) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Dokumen Persyaratan Seminar Tugas Akhir</h5>
            </div>
            <div class="card-body">
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
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_1) }}" target="_blank">Formulir pendaftaran Seminar terisi</a></td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_2) }}" target="_blank">Copy Berita Acara Pembimbingan / Kartu Bimbingan</a></td>

                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_3) }}" target="_blank">Persetujuan Seminar dari Dosen Pembimbing</a></td>

                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_4) }}" target="_blank">Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir</a></td>

                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_5) }}" target="_blank">Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP</a></td>

                        </tr>
                        <tr>
                            <td>6</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_6) }}" target="_blank">Form Bebas Tunggakan / Pinjaman</a></td>

                        </tr>
                        <tr>
                            <td>7</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_7) }}" target="_blank">Print out bukti pengecekan Plagiarisme <= 25%</a>
                            </td>

                        </tr>
                        <tr>
                            <td>8</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_8) }}" target="_blank">Bukti Monitoring Hafalan</a></td>

                        </tr>
                        <tr>
                            <td>9</td>
                            <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_9) }}" target="_blank">Bukti Penyerahan Draft</a></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Dokumen Persyaratan Sidang Tugas Akhir</h5>
            </div>
            <div class="card-body">
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
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_1) }}" target="_blank">Fotocopy Kwitansi Bimbingan TA</a></td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_2) }}" target="_blank">Fotocopy Kwitansi Sidang TA</a></td>

                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_3) }}" target="_blank">Fotocopy Kwitansi Seminar TA</a></td>

                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_4) }}" target="_blank">Fotocopy Sertifikat Pesantren Calon Sarjana</a>
                            </td>

                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_5) }}" target="_blank">Formulir Rencana Studi (FRS)</a></td>

                        </tr>
                        <tr>
                            <td>6</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_6) }}" target="_blank">Bukti Penyerahan Draft TA (4 Eksemplar)</a></td>

                        </tr>
                        <tr>
                            <td>7</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_7) }}" target="_blank">Bukti Bebas Perpustakaan Pusat UNISBA</a></td>

                        </tr>
                        <tr>
                            <td>8</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_8) }}" target="_blank">Bukti Bebas Perpustakaan TI</a></td>

                        </tr>
                        <tr>
                            <td>9</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_9) }}" target="_blank">Transkrip Nilai Terakhir</a></td>

                        </tr>
                        <tr>
                            <td>10</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_10) }}" target="_blank">Persetujuan Sidang dari Dosen Pembimbing (Kartu Bimbingan Asli)</a></td>

                        </tr>
                        <tr>
                            <td>11</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_11) }}" target="_blank">Fotocopy Sertifikat TOEFL</a></td>

                        </tr>
                        <tr>
                            <td>12</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_12) }}" target="_blank">Foto Berwarna</a></td>

                        </tr>
                        <tr>
                            <td>13</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_13) }}" target="_blank">Bebas Pinjaman / Tunggakan</a></td>

                        </tr>
                        <tr>
                            <td>14</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_14) }}" target="_blank">Menghadiri Seminar / Sidang minimal 3 kali</a>
                            </td>

                        </tr>
                        <tr>
                            <td>15</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_15) }}" target="_blank">Form Hafalan Surat Al-Quran (minimal 25 surat)</a></td>

                        </tr>
                        <tr>
                            <td>16</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_16) }}" target="_blank">Print out bukti pengecekan Plagiarisme < 25% (sebelum sidang)</a>
                            </td>

                        </tr>
                        <tr>
                            <td>17</td>
                            <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_17) }}" target="_blank">Sertifikat SKKFT yang ditandatangani oleh Wadek III</a>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection