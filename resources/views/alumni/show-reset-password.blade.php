@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Reset Password <strong>{{ $data->nama }}</strong></h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Profil Alumni</h4>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $data->foto) }}" alt="">
                    <h3 class="profile-username text-center">{{ $data->nama }}</h3>
                    <p class="text-muted text-center">{{ $data->nik }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p class="text-center">Email</p>
                            @if ($data->email != '')
                                <p class="text-center"><b>{{ $data->email }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li>
                        {{-- <li class="list-group-item">
                            <p class="text-center">Alamat</p>
                            @if ($data->alamat != '')
                                <p class="text-center"><b>{{ $data->alamat }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <p class="text-center">No. HP</p>
                            @if ($data->no_hp != '')
                                <p class="text-center"><b>{{ $data->no_hp }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h4>Form Reset Password</h4>
                </div>
                <div class="box-body">
                    <form action="{{ route('alumni.store-reset-password', $data->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="new_password" class="col-lg-4 col-lg-offset-1 control-label">Password Baru</label>
                            <div class="col-lg-7">
                                <input type="text" name="new_password" id="new_password" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <button class="btn btn-sm btn-flat btn-danger"><i class="fa fa-save"></i> Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection