@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Detail Profil {{ $data->nama }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{ID USER {{ $data->id }}}</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-profile">
            <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                <div class="profile-picture">
                    <div class="avatar avatar-xxl">
                        <img src="{{ asset('/user/foto/' . $data->foto) }}" alt="..." class="avatar-img rounded-circle" />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="user-profile text-center">
                    <div class="name">{{ $data->nama }}</div>
                    <div class="job">{{ $data->program_studi }}</div>
                    <div class="desc">{{ $data->nik }}</div>
                    
                </div>
            </div>
            <div class="card-footer">
                <div class="row user-stats text-center">
                    <div class="col">
                        <div class="number">Program Studi</div>
                        <div class="title"><strong>{{ $data->program_studi }}</strong></div>
                    </div>
                    <div class="col">
                        <div class="number">Email</div>
                        <div class="title"><strong>{{ $data->email }}</strong></div>
                    </div>
                    <div class="col">
                        <div class="number">Jabatan</div>
                        <div class="title">
                            @if ($data->level == 1)
                            <p class="text-center"><b>Tenaga Kependidikan</b></p>
                            @elseif ($data->level == 2)
                            <p class="text-center"><b>Dosen</b></p>
                            @elseif ($data->level == 3)
                            <p class="text-center"><b>Mahasiswa</b></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <form action="{{ route('user-password.reset', $data->id) }}" method="post">
        @csrf
        <button class="btn btn-danger">Reset Password</button>
    </form>
</div>

@endsection