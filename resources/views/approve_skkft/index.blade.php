@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Pengajuan Kegiatan SKKFT</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="display table table-striped table-hover table-kegiatan_skkft">
                    <thead>
                        <th width="5%">No</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th width="12%"><i class="fas fa-cogs"></i> Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($dataPengajuan as $dp)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $dp->user_skkft->nik }}</td>
                            <td><a href="{{ route('dashboardMahasiswa.show', $dp->user_id) }}">{{ $dp->user_skkft->nama }}</a></td>
                            <td>{{ $dp->nama_kegiatan }}</td>
                            <td>{{ $dp->categories_skkft->category_name }}</td>
                            <td>{{ $dp->subcategories_skkft->subcategory_name }}</td>
                            <td>
                                <a href="{{ route('approveKegiatan.edit', $dp->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
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