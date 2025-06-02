@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold"><i>Summary</i> SKKFT <strong>{{ auth()->user()->nama }}</strong></h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Data Kegiatan</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-skkft">
                    <thead>
                        <th>Nama Kegiatan</th>
                        <th>Poin</th>
                        <th width="12%" class="text-center">Status</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{$d->nama_kegiatan }}</td>
                                <td>{{$d->point }}</td>
                                <td>
                                    @if ($d->status_skkft == 1)
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif ($d->status_skkft == 0)
                                        <span class="badge badge-warning text-black">Waiting for approval</span>
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
                <h5><i>Summary</i> Kegiatan</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th class="text-center">Kategori</th>
                        <th width="12%">Poin</th>
                        <th width="40%" class="text-center">Keterangan</th>
                    </thead>
                    <tbody>
                        @foreach ($poinKategori as $pk)
                            <tr>
                                <td>{{ $pk['category'] }}</td>
                                <td>{{ $pk['poin'] }}</td>
                                <td>
                                    @if ($pk['lolos'])
                                        <div class="alert alert-success alert-dismissible">
                                            Poin Sudah Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                        </div>
                                        @else
                                        <div class="alert alert-warning alert-dismissible text-black">
                                            Poin Belum Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td class="text-right" colspan="1"><b>Total Poin</b></td>
                                <td colspan="2"><b>{{ $totalPoin }}</b></td>
                            </tr>
                            <tr>
                                @if (
                                    is_null($dataSertifikat) &&
                                    $totalPoin >= 150 &&
                                    ($poinKategori['1']['poin'] >= 40) &&
                                    ($poinKategori['2']['poin'] >= 30) &&
                                    ($poinKategori['3']['poin'] >= 30) &&
                                    ($poinKategori['4']['poin'] >= 20) &&
                                    ($poinKategori['5']['poin'] >= 15) &&
                                    ($poinKategori['6']['poin'] >= 15)
                                )
                                    <td colspan="4" class="text-center">
                                        <form action="{{ route('sertifikat.store') }}" method="POST">@csrf
                                            <button type="submit" class="btn btn-flat btn-md btn-success">Ajukan Sertifikat</button>
                                        </form>
                                    </td>
                                @elseif (is_null($dataSertifikat) && $totalPoin >= 400 && $userS2)
                                    <td colspan="4" class="text-center">
                                        <form action="{{ route('sertifikat.store') }}" method="POST">@csrf
                                            <button type="submit" class="btn btn-flat btn-md btn-success">Ajukan Sertifikat</button>
                                        </form>
                                    </td>
                                @else
                                    <td colspan="4" class="text-center">
                                        <button type="submit" class="btn btn-flat btn-md btn-success" disabled>Ajukan Sertifikat</button>
                                    </td>
                                @endif
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if (!is_null($statusSertifikatSkkft) && $statusSertifikatSkkft->status == 1)
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Selamat!</h4>
                Pengajuan sertifikat SKKFT telah disetujui, silahkan klik <a href="{{ route('sertifikatSkkft.generate') }}">Disini </a>untuk unduh sertifikat.
            </div>
        </div>
    </div>
@endif

@endsection