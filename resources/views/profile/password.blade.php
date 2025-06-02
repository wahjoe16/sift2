@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Update Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.password') }}" method="post">@csrf
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" name="old_password" id="old_password" class="form-control" minlength="6">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="6">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-match="#password">
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-flat btn-success">Simpan</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-flat btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection