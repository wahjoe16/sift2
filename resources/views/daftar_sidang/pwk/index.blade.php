@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Sidang Terbuka</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    @if (is_null($dataLogSeminar) || !is_null($dataLogSidang) || !$dataSeminar || is_null($dataSertifikatSkkft))
                    <a href="#" class="btn btn-success btn-sm btn-flat disabled"><i class="fa fa-upload"></i> Ajukan</a>
                    @elseif (is_null($dataLogSidang) || $dataSeminar)
                    <a href="{{ route('sidang_pwk.daftar') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-upload"></i> Ajukan</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-seminar">
                    <thead>
                        <th>Tahun Akademik</th>
                        <th>Semester</th>
                        <th>Dosen Pembimbing 1</th>
                        <th>Dosen Pembimbing 2</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($dataSidang as $d)
                        <tr>
                            <td>{{ $d->tahun_ajaran->tahun_ajaran }}</td>
                            <td>{{ $d->semester->semester }}</td>
                            <td>{{ $d->dosen_1->nama }}</td>
                            @if ($d->dosen_2 != '')
                            <td>{{ $d->dosen_2->nama }}</td>
                            @else
                            <td>-</td>
                            @endif
                            <td>{{ tanggal_indonesia($d->created_at, false) }}</td>

                            @if ($d->status == 0)
                            <td><span class="badge badge-warning text-black">Menunggu</span></td>
                            @elseif ($d->status == 1)
                            <td><span class="badge badge-success">Diterima</span></td>
                            @elseif ($d->status == 2)
                            <td><span class="badge badge-danger">Ditolak</span></td>
                            @endif

                            <td><a href="{{ route('sidang_pwk.show', $d->id) }}"><i class="fa fa-search"></i></a></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <img src="{{ asset('sidang/Flow chart pwk.png') }}" alt="" width="1000px" srcset="">
    </div>
</div>

@endsection