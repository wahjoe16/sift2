@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Pengajuan Kegiatan SKKFT</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered table-kegiatan_skkft">
                            <thead>
                                <th width="5%">No</th>
                                <th>NPM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nama Kegiatan</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($dataPengajuan as $dp)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $dp->user_skkft->nik }}</td>
                                    <td>{{ $dp->user_skkft->nama }}</td>
                                    <td>{{ $dp->nama_kegiatan }}</td>
                                    <td>{{ $dp->categories_skkft->category_name }}</td>
                                    <td>{{ $dp->subcategories_skkft->subcategory_name }}</td>
                                    <td>
                                        <a href="{{ route('approveKegiatan.edit', $dp->id) }}" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('approveKegiatan.destroy', $dp->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
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
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    
</script>
@endpush