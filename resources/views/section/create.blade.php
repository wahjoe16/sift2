@extends('layouts.master')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        {{ $title }}
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('sections.store') }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-lg-offset-1 control-label">Nama Bidang Arsip</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" id="name" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="description">Deskripsi Bidang Arsip</label>
                            <div class="col-sm-6">
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('sections.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection