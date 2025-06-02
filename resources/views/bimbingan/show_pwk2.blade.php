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
                <h3 class="card-title">Judul Skripsi</h3>
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
                <h5>Dokumen Sidang Pembahasan</h5>
            </div>
            <div class="card-body">
                <table class="table">
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Dokumen Sidang Terbuka</h5>
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

@endsection