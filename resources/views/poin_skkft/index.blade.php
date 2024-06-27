@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('poin-skkft.create') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="{{ route('poin-skkft.create') }}" method="post" class="form-admin">@csrf
                        <table class="table table-striped table-bordered table-poin_skkft">
                            <thead>
                                <th width="5%">No</th>
                                <th>Kategori</th>
                                <th>Subkategori</th>
                                <th>Tingkat</th>
                                <th>Prestasi</th>
                                <th>Jabatan</th>
                                <th>Poin</th>
                                <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($poin_skkft as $ps)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$ps->categories_skkft->category_name}}</td>
                                    <td>{{$ps->subcategories_skkft->subcategory_name}}</td>
                                    @if ($ps->tingkat_id != '')
                                        <td>{{$ps->tingkat_skkft->tingkat}}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    @if ($ps->prestasi_id != '')
                                        <td>{{$ps->prestasi_skkft->prestasi}}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    @if ($ps->jabatan_id != '')
                                        <td>{{$ps->jabatan_skkft->jabatan}}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    <td>{{ $ps->point }}</td>
                                    <td>
                                        <a href="{{ route('poin-skkft.edit', $ps->id) }}" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('poin-skkft.destroy', $ps->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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