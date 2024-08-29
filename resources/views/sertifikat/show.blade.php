@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Rekap SKKFT <strong>{{ $dataSertifikat->user_skkft->nama }}</strong></h3>
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
                                    @foreach ($dataKegiatan as $dk)
                                        <tr>
                                            <td>{{$loop->index + 1 }}</td>
                                            <td>{{ $dk->nama_kegiatan }}</td>
                                            <td>{{ $dk->point }}</td>
                                            <td>
                                                @if ($dk->status_skkft == 1)
                                                    <span class="label label-success">Diterima</span>
                                                @else
                                                    <span class="label label-danger">Ditolak</span>
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