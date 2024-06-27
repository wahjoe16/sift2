@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('subcategory-skkft.create') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="{{ route('subcategory-skkft.create') }}" method="post" class="form-admin">@csrf
                        <table class="table table-striped table-bordered table-subcategory_skkft">
                            <thead>
                                <th width="5%">No</th>
                                <th>Kategori</th>
                                <th>Subkategori</th>
                                <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($subcategory_skkft as $scs)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$scs->categories_skkft->category_name}}</td>
                                    <td>{{$scs->subcategory_name}}</td>
                                    <td>
                                        <a href="{{ route('subcategory-skkft.edit', $scs->id) }}" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('subcategory-skkft.destroy', $scs->id) }}" method="post" class="d-inline">
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