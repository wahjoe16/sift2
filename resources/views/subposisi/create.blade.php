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
                    <form action="{{ route('subposisi-pekerjaan.store') }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="nama_posisi" class="col-lg-2 col-lg-offset-1 control-label">Nama Posisi</label>
                            <div class="col-lg-6">
                                <select name="nama_posisi" id="nama_posisi" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($data as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_posisi }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_subposisi" class="col-lg-2 col-lg-offset-1 control-label">Nama Sub Posisi</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_subposisi" id="nama_subposisi" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('subposisi-pekerjaan.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection