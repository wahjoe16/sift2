@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Rangkuman SKKFT <strong>{{ auth()->user()->nama }}</strong></h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-striped table-bordered table-skkft">
                                <thead>
                                    <th width="5%">No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Poin</th>
                                    <th width="12%"><i class="fa fa-cogs"></i></th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{$loop->index + 1 }}</td>
                                            <td>{{$d->nama_kegiatan }}</td>
                                            <td>{{$d->point }}</td>
                                            <td>
                                                @if ($d->status_skkft == 1)
                                                    <span class="label label-success">Disetujui</span>
                                                @else
                                                    <span class="label label-warning">Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th width="5%">#</th>
                                    <th>Kategori</th>
                                    <th width="20%">Poin</th>
                                    <th width="12%">Keterangan</th>
                                </thead>
                                <tbody>
                                    @foreach ($poinKategori as $pk)
                                        <tr>
                                            <td>{{ $pk['id'] }}</td>
                                            <td>{{ $pk['category'] }}</td>
                                            <td>{{ $pk['poin'] }}</td>
                                            <td>
                                                @if ($pk['lolos'])
                                                    Poin Sudah Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                                    @else
                                                    Poin Belum Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td class="text-right" colspan="2"><b>Total Poin</b></td>
                                            <td colspan="2"><b>{{ $totalPoin }}</b></td>
                                        </tr>
                                        <tr>
                                            @if (
                                                is_null($dataSertifikat) &&
                                                $totalPoin >= 150 &&
                                                ($poinKategori['1']['poin'] >= 40) &&
                                                ($poinKategori['3']['poin'] >= 30) &&
                                                ($poinKategori['4']['poin'] >= 30) &&
                                                ($poinKategori['5']['poin'] >= 15) &&
                                                ($poinKategori['6']['poin'] >= 10) &&
                                                ($poinKategori['7']['poin'] >= 15)
                                            )
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
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    // let table;

    // $(function() {
    //     table = $('.table-skkft').DataTable({
    //         processing: true,
    //         autoWidth: false,
    //         url: '{{ route("kegiatan.data") }}',
    //         columns: [
    //             { data: 'id' },
    //             { data: 'nama_kegiatan' },
    //             { data: 'poin', searchable: false, sortable: false },
    //             { data: 'aksi', searchable: false, sortable: false },
    //         ]
    //     })
    // })
</script>
@endpush