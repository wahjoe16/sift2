@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Satuan Kegiatan Kemahasiswaan Fakultas Teknik (SKKFT)</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Rekap SKKFT <strong>{{ $dataSertifikat->user_skkft->nama }}</strong></h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-skkft">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama Kegiatan</th>
                        <th>Poin</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($dataKegiatan as $dk)
                            <tr>
                                <td>{{$loop->index + 1 }}</td>
                                <td>{{ $dk->nama_kegiatan }}</td>
                                <td>{{ $dk->point }}</td>
                                <td>
                                    @if ($dk->status_skkft == 1)
                                        <span class="badge badge-success">Diterima</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Summary SKKFT</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th width="5%">#</th>
                        <th class="text-center">Kategori</th>
                        <th width="12%">Poin</th>
                        <th width="40%" class="text-center">Keterangan</th>
                    </thead>
                    <tbody>
                        @foreach ($poinKategori as $pk)
                            <tr>
                                <td><strong>{{ $pk['id'] }}</strong></td>
                                <td><strong>{{ $pk['category'] }}</strong></td>
                                <td><strong>{{ $pk['poin'] }}</strong></td>
                                <td>
                                    @if ($pk['lolos'])
                                        <div class="alert alert-success alert-dismissible">
                                            Poin Sudah Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                        </div>
                                        @else
                                        <div class="alert alert-warning alert-dismissible">
                                            Poin Belum Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td class="text-right" colspan="2"><b>Total Poin</b></td>
                                <td colspan="2"><b>{{ $totalPoin }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <form action="{{ route('sertifikat.verify', $dataSertifikat->id) }}" method="POST">@csrf
                                        <button type="submit" class="btn btn-success btn-md btn-flat">Terbitkan Sertifikat</button>
                                    </form>
                                </td>
                                <td colspan="2" class="text-center">
                                    <form action="{{ route('sertifikat.reject', $dataSertifikat->id) }}" method="POST">@csrf
                                        <button type="submit" class="btn btn-danger btn-md btn-flat">Tolak Sertifikat</button>
                                    </form>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
