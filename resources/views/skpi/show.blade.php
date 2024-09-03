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
                                    <th>Link Bukti Fisik</th>
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
                                            <td class="text-center"><a href="{{ url('/mahasiswa/skkft', $d->bukti_fisik) }}" target="_blank"><i class="fa fa-link"></i></a></td>
                                            <td>
                                                <form action="{{ route('skpi.deleteKegiatan', $d->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></button>
                                                </form>
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
    
</script>
@endpush