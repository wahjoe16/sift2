@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Reset Password <strong>{{ $data->nama }}</strong></h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-profile">
            <div class="card-header">
                <div class="profile-picture">
                    <div class="avatar avatar-xxl">
                        <img src="{{ asset('/user/foto/' . $data->foto) }}" alt="..." class="avatar-img rounded-circle" />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="user-profile text-center">
                    <div class="name">{{ $data->nama }}</div>
                    <div class="job">{{ $data->email }}</div>
                    <div class="desc">{{ $data->alamat }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Form Reset Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('alumni.store-reset-password', $data->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="text" name="new_password" id="new_password" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-7">
                            <button class="btn btn-sm btn-danger"><i class="fa fa-save"></i> Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection