@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Satuan Kegiatan Kemahasiswaan Fakultas Teknik (SKKFT)</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Pengajuan Sertifikat SKKFT</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sertifikat_skkft">
                    <thead>
                        <th>Foto Profil</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Program Studi</th>
                        <th>Tanggal Pengajuan</th>
                        <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>
                                <div class="avatar-lg text-center">
                                    <img src="{{ route('user.foto', $d->user_skkft->id ?? '') }}" alt="..." class="avatar-img rounded-circle" />
                                    {{-- <img src="{{ url('/user/foto/', $d->user_skkft->foto ?? '') }}" alt="..." class="avatar-img rounded-circle" /> --}}
                                </div>
                            </td>
                            <td>{{ $d->user_skkft->nama }}</td>
                            <td>{{ $d->user_skkft->nik }}</td>
                            <td>{{ $d->user_skkft->program_studi }}</td>
                            <td>{{ tanggal_indonesia($d->tanggal, false) }}</td>
                            <td>
                                <a href="{{ route('sertifikat.show', $d->id) }}" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection