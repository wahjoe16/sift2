@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Approval Sidang Tugas Akhir</h3>
    </div>
</div>

@include('layouts.alert')

<form action="{{ route('approve-sidangTi.store', $data->id) }}" class="form-horizontal" method="post">@csrf
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
                    <h3 class="card-title">Pembimbing 1</h3>
                    <p class="card-text">{{ $data->dosen_1->nama }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Pembimbing 2</h3>
                    @if ($data->dosen_2 != '')
                    <p class="card-text">{{ $data->dosen_2->nama }}</p>
                    @else
                    <p class="card-text">-</p>
                    @endif

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Penguji 1 Seminar</h3>
                    @if ($data->dosen_3 != '')
                    <p class="card-text">{{ $data->dosen_3->nama }}</p>
                    @else
                    <p class="card-text">-</p>
                    @endif

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Penguji 2 Seminar</h3>
                    @if ($data->dosen_4 != '')
                    <p class="card-text">{{ $data->dosen_4->nama }}</p>
                    @else
                    <p class="card-text">-</p>
                    @endif

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Judul Tugas Akhir</h3>
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
                    <table class="table">
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
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_1) }}" target="_blank">Fotocopy Kwitansi Bimbingan TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_2) }}" target="_blank">Fotocopy Kwitansi Sidang TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_3) }}" target="_blank">Fotocopy Kwitansi Seminar TA</a></td>
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
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_4) }}" target="_blank">Fotocopy Sertifikat Pesantren Calon Sarjana</a></td>
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
                                <td>5</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_5) }}" target="_blank">Formulir Rencana Studi (FRS)</a></td>
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
                            <tr>
                                <td>6</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_6) }}" target="_blank">Bukti Penyerahan Draft TA</a></td>
                                <td>
                                    @if ($data->status_6 == 2)
                                    <input type="radio" name="status_6" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_6 == 0)
                                    <input type="radio" name="status_6" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_6 == 1)
                                    <input type="radio" name="status_6" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_6 == 0)
                                    <input type="radio" name="status_6" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_6" id="keterangan_6" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_7) }}" target="_blank">Bukti Bebas Perpustakaan Pusat UNISBA</a>
                                </td>
                                <td>
                                    @if ($data->status_7 == 2)
                                    <input type="radio" name="status_7" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_7 == 0)
                                    <input type="radio" name="status_7" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_7 == 1)
                                    <input type="radio" name="status_7" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_7 == 0)
                                    <input type="radio" name="status_7" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_7" id="keterangan_7" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_8) }}" target="_blank">Bukti Bebas Perpustakaan TI</a></td>
                                <td>
                                    @if ($data->status_8 == 2)
                                    <input type="radio" name="status_8" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_8 == 0)
                                    <input type="radio" name="status_8" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_8 == 1)
                                    <input type="radio" name="status_8" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_8 == 0)
                                    <input type="radio" name="status_8" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_8" id="keterangan_8" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_9) }}" target="_blank">Transkrip Nilai Terakhir</a></td>
                                <td>
                                    @if ($data->status_9 == 2)
                                    <input type="radio" name="status_9" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_9 == 0)
                                    <input type="radio" name="status_9" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_9 == 1)
                                    <input type="radio" name="status_9" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_9 == 0)
                                    <input type="radio" name="status_9" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_9" id="keterangan_9" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_10) }}" target="_blank">Persetujuan Sidang dari Dosen Pembimbing</a></td>
                                <td>
                                    @if ($data->status_10 == 2)
                                    <input type="radio" name="status_10" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_10 == 0)
                                    <input type="radio" name="status_10" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_10 == 1)
                                    <input type="radio" name="status_10" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_10 == 0)
                                    <input type="radio" name="status_10" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_10" id="keterangan_10" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_11) }}" target="_blank">Fotocopy Sertifikat TOEFL</a></td>
                                <td>
                                    @if ($data->status_11 == 2)
                                    <input type="radio" name="status_11" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_11 == 0)
                                    <input type="radio" name="status_11" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_11 == 1)
                                    <input type="radio" name="status_11" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_11 == 0)
                                    <input type="radio" name="status_11" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_11" id="keterangan_11" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_12) }}" target="_blank">Foto Berwarna</a></td>
                                <td>
                                    @if ($data->status_12 == 2)
                                    <input type="radio" name="status_12" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_12 == 0)
                                    <input type="radio" name="status_12" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_12 == 1)
                                    <input type="radio" name="status_12" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_12 == 0)
                                    <input type="radio" name="status_12" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_12" id="keterangan_12" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_13) }}" target="_blank">Bukti Bebas Pinjaman / Tunggakan</a></td>
                                <td>
                                    @if ($data->status_13 == 2)
                                    <input type="radio" name="status_13" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_13 == 0)
                                    <input type="radio" name="status_13" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_13 == 1)
                                    <input type="radio" name="status_13" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_13 == 0)
                                    <input type="radio" name="status_13" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_13" id="keterangan_13" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_14) }}" target="_blank">Menghadiri Seminar / Sidang minimal 3 kali</a></td>
                                <td>
                                    @if ($data->status_14 == 2)
                                    <input type="radio" name="status_14" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_14 == 0)
                                    <input type="radio" name="status_14" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_14 == 1)
                                    <input type="radio" name="status_14" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_14 == 0)
                                    <input type="radio" name="status_14" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_14" id="keterangan_14" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_15) }}" target="_blank">Form Hafalan Surat Al-Quran (minimal 25 surat)</a></td>
                                <td>
                                    @if ($data->status_15 == 2)
                                    <input type="radio" name="status_15" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_15 == 0)
                                    <input type="radio" name="status_15" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_15 == 1)
                                    <input type="radio" name="status_15" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_15 == 0)
                                    <input type="radio" name="status_15" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_15" id="keterangan_15" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_16) }}" target="_blank">Print out bukti pengecekan Plagiarisme < 25% (sebelum sidang)</a>
                                </td>
                                <td>
                                    @if ($data->status_16 == 2)
                                    <input type="radio" name="status_16" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_16 == 0)
                                    <input type="radio" name="status_16" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_16 == 1)
                                    <input type="radio" name="status_16" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_16 == 0)
                                    <input type="radio" name="status_16" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_16" id="keterangan_16" cols="30" rows="1" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $data->syarat_17) }}" target="_blank">Sertifikat SKKFT yang ditandatangani oleh Wadek III</a>
                                </td>
                                <td>
                                    @if ($data->status_17 == 2)
                                    <input type="radio" name="status_17" value="2" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_17 == 0)
                                    <input type="radio" name="status_17" value="2" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_17 == 1)
                                    <input type="radio" name="status_17" value="1" class="form-check-input" checked="checked" readonly>
                                    @elseif ($data->status_17 == 0)
                                    <input type="radio" name="status_17" value="1" class="form-check-input">
                                    @endif
                                </td>
                                <td>
                                    <textarea name="keterangan_17" id="keterangan_17" cols="30" rows="1" class="form-control"></textarea>
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
            <a href="{{ route('view-sidangTi.index') }}" class="btn btn-link">Batal</a>
        </div>
    </div>
</form>

@endsection