@extends('layouts.master')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        Edit data Tahun Ajaran
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('tahunajaran.update', $data->id) }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="tahun_ajaran" class="col-lg-2 col-lg-offset-1 control-label">Aahun Ajaran</label>
                            <div class="col-lg-6">
                                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" value="{{ $data->tahun_ajaran }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
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
</section>

@endsection