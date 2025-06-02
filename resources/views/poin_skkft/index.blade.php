@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">{{ $title }}</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('poin-skkft.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-poin_skkft">
                    <thead>
                        <th>Kategori</th>
                        <th>Subkategori</th>
                        <th>Tingkat</th>
                        <th>Prestasi</th>
                        <th>Jabatan</th>
                        <th>Poin</th>
                        <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                    <tfoot>
                        <th>Kategori</th>
                        <th>Subkategori</th>
                        <th>Tingkat</th>
                        <th>Prestasi</th>
                        <th>Jabatan</th>
                        <th>Poin</th>
                        <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                    </tfoot>
                    <tbody>
                        @foreach($poin_skkft as $ps)
                        <tr>
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
                                <a href="{{ route('poin-skkft.edit', $ps->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('poin-skkft.destroy', $ps->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
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

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('poin-skkft.create') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="{{ route('poin-skkft.create') }}" method="post" class="form-admin">@csrf
                        
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