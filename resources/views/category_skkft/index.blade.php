@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Data Kategori SKKFT</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('category-skkft.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" class="form-admin">@csrf
                    <table class="table table-striped table-category_skkft">
                        <thead>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th>Bobot</th>
                            <th width="9%"><i class="fas fa-cogs"></i> Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($category_skkft as $cs)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$cs->category_name}}</td>
                                <td>{{$cs->bobot}}</td>
                                <td>
                                    <a href="{{ route('category-skkft.edit', $cs->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('category-skkft.destroy', $cs->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
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

@endsection
