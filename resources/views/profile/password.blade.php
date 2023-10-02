@extends('layouts.dashboard')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('update.password') }}" method="post">@csrf
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Password</h3>
                    </div>
                    <div class="box-body">

                        <div class="alert alert-info alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                        </div>
                        <div class="form-group row">
                            <label for="old_password" class="col-lg-2 control-label">Password Lama</label>
                            <div class="col-lg-6">
                                <input type="password" name="old_password" id="old_password" class="form-control" minlength="6">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" id="password" class="form-control" minlength="6">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-lg-2 control-label">Konfirmasi Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-match="#password">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-success">Simpan</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-flat btn-danger">Batal</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </form>
        </div>
    </div>
</section>

@endsection