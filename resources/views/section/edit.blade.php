@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Bidang Arsip</h3>
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
                <form action="{{ route('sections.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Bidang</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Bidang</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $data->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('sections.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-circle-left"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    
                </div>
                <div class="box-body">
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection