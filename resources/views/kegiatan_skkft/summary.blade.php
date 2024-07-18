@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Rangkuman SKKFT {{ auth()->user()->nama }}</h3>
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
                                            <td></td>
                                            <td class="text-right"><b>Total Poin</b></td>
                                            <td><b>{{ $totalPoin }}</b></td>
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
    let table;

    $(function() {
        table = $('.table-skkft').DataTable({
            processing: true,
            autoWidth: false,
            url: '{{ route("kegiatan.data") }}',
            columns: [
                { data: 'id' },
                { data: 'nama_kegiatan' },
                { data: 'poin', searchable: false, sortable: false },
                { data: 'aksi', searchable: false, sortable: false },
            ]
        })
    })
</script>
@endpush