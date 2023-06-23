@extends('layouts.master')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        Edit data user
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.update', $admin->id) }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="nik" class="col-lg-2 col-lg-offset-1 control-label">NPM</label>
                            <div class="col-lg-6">
                                <input type="text" name="nik" id="nik" class="form-control" value="{{ $admin->nik }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $admin->nama }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_superadmin" class="col-lg-2 col-lg-offset-1 control-label">Status Superadmin</label>
                            <div class="col-lg-6">
                                <select name="status_superadmin" id="status_superadmin" class="form-control text-black">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "0"=>"Tidak",
                                    "1"=>"Ya"
                                    ] as $status => $statusLabel)
                                    <option value="{{ $status }}" {{ old('status_superadmin', $admin->status_superadmin)==$status ? "selected" : "" }}>{{ $statusLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                            <div class="col-lg-6">
                                <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-lg-2 col-lg-offset-1 control-label">Telepon</label>
                            <div class="col-lg-6">
                                <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $admin->telepon }}" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('admin.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection