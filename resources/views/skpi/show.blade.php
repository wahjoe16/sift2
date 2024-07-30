@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Rekap SKKFT <strong>{{ $data->user_skkft->nama }}</strong></h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-skkft">
                                <thead>
                                    <th width="5%">No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Kategori</th>
                                    <th>Sub Kategori</th>
                                    <th>Tingkat</th>
                                    <th>Prestasi</th>
                                    <th>Jabatan</th>
                                    <th>Poin</th>
                                    <th width="12%"><i class="fa fa-cogs"></i></th>
                                </thead>
                                <tbody>
                                    @foreach ($dataKegiatan as $d)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $d->nama_kegiatan }}</td>
                                            <td>{{ $d->categories_skkft->category_name }}</td>
                                            <td>{{ $d->subcategories_skkft->subcategory_name }}</td>
                                            <td>
                                                @if ($d->tingkat_id != '')
                                                    {{ $d->tingkat_skkft->tingkat }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->prestasi_id != '')
                                                    {{ $d->prestasi_skkft->prestasi }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->jabatan_id != '')
                                                    {{ $d->jabatan_skkft->jabatan }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td><strong>{{ $d->point }}</strong></td>
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
                    </div>
                </div>
                <div class="box-footer with-border">
                    <form action="{{ route('skpi.verify', $data->id) }}" method="POST">@csrf
                        <button type="submit" class="btn btn-info btn-md btn-flat"><i class="fa fa-check"></i> Terbitkan SKPI</button>
                    </form>
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