@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Kategori Arsip</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    {{ $title }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('category-archive.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="section_id">Bidang Arsip</label>
                        <select name="section_id" id="section_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($section as $s)
                            <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['section_id'])) selected @endif>{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Kategori Arsip</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Kategori Arsip</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $data->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('category-archive.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection