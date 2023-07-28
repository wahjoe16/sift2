@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="btn-group">
                        @if (is_null($dataLogSeminar) || !is_null($dataLogSidang) || !$dataSeminar)
                        <a href="#" class="btn btn-success btn-sm btn-flat disabled"><i class="fa fa-upload"></i> Ajukan</a>
                        @elseif (is_null($dataLogSidang) || $dataSeminar)
                        <a href="{{ route('sidang_pwk.daftar') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-upload"></i> Ajukan</a>
                        @endif
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-seminar">
                        <thead>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Dosen Pembimbing 1</th>
                            <th>Dosen Pembimbing 2</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cogs"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($dataSidang as $d)
                            <tr>
                                <td>{{ $d->tahun_ajaran->tahun_ajaran }}</td>
                                <td>{{ $d->semester->semester }}</td>
                                <td>{{ $d->dosen_1->nama }}</td>
                                <td>{{ $d->dosen_2->nama }}</td>
                                <td>{{ tanggal_indonesia($d->created_at, false) }}</td>

                                @if ($d->status == 0)
                                <td><span class="label bg-yellow text-black">Menunggu</span></td>
                                @elseif ($d->status == 1)
                                <td><span class="label bg-green">Diterima</span></td>
                                @elseif ($d->status == 2)
                                <td><span class="label bg-red">Ditolak</span></td>
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
</section>

@includeIf('mahasiswa.form')

@endsection

@push('scripts_page')
<script>

</script>
@endpush