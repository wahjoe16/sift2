@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Sub Posisi Pekerjaan Alumni</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('subposisi-pekerjaan.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-posisi">
                    <thead>
                        <th width="5%">No</th>
                        <th>Posisi Pekerjaan</th>
                        <th>Sub Posisi Pekerjaan</th>
                        <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d => $value)
                            <tr>
                                <td>{{ $d + 1 }}</td>
                                <td>{{ $value->posisi->nama_posisi }}</td>
                                <td>{{ $value->nama_posisi }}</td>
                                <td>
                                    <a href="{{ route('subposisi-pekerjaan.edit', $value->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('subposisi-pekerjaan.destroy', $value->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection