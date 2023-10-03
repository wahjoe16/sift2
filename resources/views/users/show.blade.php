@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Detail Profil {{ $data->nama }}</h3>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Informasi User</h4>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $data->foto) }}" alt="">
                    <h3 class="profile-username text-center">{{ $data->nama }}</h3>
                    <p class="text-muted text-center">{{ $data->nik }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <p class="text-center">Program Studi</p>
                            <p class="text-center"><b>{{ $data->program_studi }}</b></p>
                        </li>
                        <li class="list-group-item">
                            <p class="text-center">Email</p>
                            <p class="text-center"><b>{{ $data->email }}</b></p>
                        </li>
                        <li class="list-group-item">
                            <p class="text-center">Jabatan</p>
                            @if ($data->level == 1)
                            <p class="text-center"><b>Tenaga Kependidikan</b></p>
                            @elseif ($data->level == 2)
                            <p class="text-center"><b>Dosen</b></p>
                            @elseif ($data->level == 3)
                            <p class="text-center"><b>Mahasiswa</b></p>
                            @endif

                        </li>
                    </ul>
                </div>
                <div class="box-footer">
                    <form action="{{ route('user-password.reset', $data->id) }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-flat btn-danger">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection