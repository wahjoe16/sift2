@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Tahun Akademik</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Edit data Tahun Akademik
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tahunajaran.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Akademik</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" value="{{ $data->tahun_ajaran }}" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('tahunajaran.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
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