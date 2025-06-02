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
                    <a href="{{ route('subcategory-skkft.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-subcategory_skkft">
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
                                <a href="{{ route('subcategory-skkft.edit', $scs->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('subcategory-skkft.destroy', $scs->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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

@endsection