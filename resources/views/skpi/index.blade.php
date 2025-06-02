@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">SURAT KETERANGAN PENDAMPING IJAZAH (SKPI)</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Pengajuan SKPI</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sertifikat_skkft">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Program Studi</th>
                        <th>Tanggal Pengajuan</th>
                        <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $d->user_skkft->nama }}</td>
                            <td>{{ $d->user_skkft->nik }}</td>
                            <td>{{ $d->user_skkft->program_studi }}</td>
                            <td>{{ tanggal_indonesia($d->tanggal) }}</td>
                            <td>
                                <a href="{{ route('skpi.show', $d->id) }}" class="btn btn-info btn-flat btn-xs"><i class="fas fa-search"></i></a>
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