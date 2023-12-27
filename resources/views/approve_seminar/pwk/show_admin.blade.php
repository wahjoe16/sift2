@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data Sidang Pembahasan {{ $data->mahasiswa->nama }}</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Sidang Pembahasan</h3>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $data->mahasiswa->foto) }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $data->mahasiswa->nama }}</h3>
                    <p class="text-muted text-center">{{ $data->mahasiswa->nik }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p>Tahun Ajaran</p>
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
                            @if ($data->syarat_1 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat01', $data->syarat_1) }}" target="_blank">Lembar bimbingan skripsi</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_2 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat02', $data->syarat_2) }}" target="_blank">Sertifikat pesantren mahasiswa baru</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_3 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat03', $data->syarat_3) }}" target="_blank">Sertifikat pesantren calon sarjana</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_4 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat04', $data->syarat_4) }}" target="_blank">Transkrip nilai</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_5 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat05', $data->syarat_5) }}" target="_blank">Sertifikat TOEFL</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_6 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat06', $data->syarat_6) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_7 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat07', $data->syarat_7) }}" target="_blank">Sertifikat SKKFT</a>
                                </td>

                            </tr>

                            @endif
                            @if ($data->syarat_8 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat08', $data->syarat_8) }}" target="_blank">Bukti KRS (pengambilan MK. Skripsi)</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_9 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat09', $data->syarat_9) }}" target="_blank">Bukti pembayaran DPP Mk. Skripsi</a></td>

                            </tr>

                            @endif
                            @if ($data->syarat_10 != '')
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar/syarat10', $data->syarat_10) }}" target="_blank">Bukti pembayaran sidang pembahasan</a></td>

                            </tr>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection