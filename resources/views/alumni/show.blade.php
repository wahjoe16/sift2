@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Detail Profil <strong>{{ $data->nama }}</strong></h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
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
                            <p class="text-center">Program Studi</p>
                            @if ($data->program_studi != '')
                                <p class="text-center"><b>{{ $data->program_studi }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <p class="text-center">Email</p>
                            @if ($data->email != '')
                                <p class="text-center"><b>{{ $data->email }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <p class="text-center">Telepon</p>
                            @if ($data->telepon != '')
                                <p class="text-center"><b>{{ $data->telepon }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="box-footer with-border text-center">
                    <form action="{{ route('alumni.reset-password', $data->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-flat btn-danger">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Informasi Lulusan</h4>
                </div>
                <div class="box-body">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p>Tahun Lulus</p>
                            <p><b>{{ $alumni->tahun_lulus }}</b></p>
                        </li>
                        <li class="list-group-item">
                            <p>Pekerjaan Sekarang</p>
                            @if ($alumni->pekerjaan_sekarang != '')
                                <p><b>{{ $alumni->pekerjaan_sekarang }}</b></p>
                            @else
                                <p>-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <p>Perusahaan Sekarang</p>
                            @if ($alumni->perusahaan_sekarang != '')
                                <p><b>{{ $alumni->perusahaan_sekarang }}</b></p>
                            @else
                                <p>-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <p>Alamat Perusahaan</p>
                            @if ($alumni->alamat != '')
                                <p><b>{{ $alumni->alamat }}</b></p>
                            @else
                                <p>-</p>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection