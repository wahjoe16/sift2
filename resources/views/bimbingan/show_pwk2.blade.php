@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data Sidang Skripsi {{ $dataSidang->mahasiswa->nama }}</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Sidang Skripsi</h3>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $dataSidang->mahasiswa->foto) }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $dataSidang->mahasiswa->nama }}</h3>
                    <p class="text-muted text-center">{{ $dataSidang->mahasiswa->nik }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p>Tahun Akademik</p>
                            <b>{{ $dataSidang->tahun_ajaran->tahun_ajaran }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Semester</p>
                            <b>{{ $dataSidang->semester->semester }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Pembimbing</p>
                            <b>{{ $dataSidang->dosen_1->nama }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Co. Pembimbing</p>
                            @if ($dataSidang->dosen_2 != '')
                            <b>{{ $dataSidang->dosen_2->nama }}</b>
                            @else
                            <b>-</b>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <p>Judul Skripsi</p>
                            <b>{{ $dataSidang->judul_skripsi }}</b>
                        </li>
                        <li class="list-group-item">
                            <p>Tanggal Pengajuan</p>
                            <b>{{ tanggal_indonesia($dataSidang->created_at) }}</b>
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($dataSeminar->syarat_1 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_1) }}" target="_blank">Lembar bimbingan skripsi</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_2 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_2) }}" target="_blank">Sertifikat pesantren mahasiswa baru</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_3 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_3) }}" target="_blank">Sertifikat pesantren calon sarjana</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_4 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_4) }}" target="_blank">Transkrip nilai</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_5 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_5) }}" target="_blank">Sertifikat TOEFL</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_6 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_6) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_7 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_7) }}" target="_blank">Sertifikat SKKFT</a>
                                </td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_8 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_8) }}" target="_blank">Bukti KRS (pengambilan MK. Skripsi)</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_9 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_9) }}" target="_blank">Bukti pembayaran DPP Mk. Skripsi</a></td>

                            </tr>

                            @endif
                            @if ($dataSeminar->syarat_10 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $dataSeminar->syarat_10) }}" target="_blank">Bukti pembayaran sidang pembahasan</a></td>

                            </tr>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Dokumen Persyaratan Sidang Terbuka</h3>
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
                                <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_1) }}" target="_blank">Sertifikat pesantren calon sarjana</a></td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_2) }}" target="_blank">Transkrip nilai</a></td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_3) }}" target="_blank">Sertifikat TOEFL</a></td>

                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_4) }}" target="_blank">Sertifikat SKKFT</a></td>

                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_5) }}" target="_blank">Pemeriksaan turnitin</a></td>

                            </tr>
                            <tr>
                                <td>6</td>
                                <td><a href="{{ url('/mahasiswa/sidang', $dataSidang->syarat_6) }}" target="_blank">Bukti pembayaran sidang terbuka</a></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection