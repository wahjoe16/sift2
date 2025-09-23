@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row mt-4">
    <div>
        <h3 class="fw-bold">Sidang Tugas Akhir</h3>
    </div>
</div>

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
                <h6 class="card-title">Penguji 1 Seminar</h6>
                @if ($data->dosen_3 != '')
                <p class="card-text">{{ $data->dosen_3->nama }}</p>
                @else
                <p class="card-text">-</p>
                @endif

                <div class="separator-solid"></div>
                <h6 class="card-title">Penguji 2 Seminar</h6>
                @if ($data->dosen_4 != '')
                <p class="card-text">{{ $data->dosen_4->nama }}</p>
                @else
                <p class="card-text">-</p>
                @endif

                <div class="separator-solid"></div>
                <h6 class="card-title">Judul Tugas Akhir</h6>
                <p class="card-text">{{ $data->judul_skripsi }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Tanggal Pengajuan</h6>
                <p class="card-text">{{ tanggal_indonesia($data->created_at) }}</p>

                <div class="separator-solid"></div>
                <h6 class="card-title">Tanggal Approve</h6>
                <p class="card-text">{{ tanggal_indonesia($data->updated_at) }}</p>

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

@endsection