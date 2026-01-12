@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Detail Profil {{ $data->nama }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{ID USER {{ $data->id }}}</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                <div class="profile-picture">
                    <div class="avatar avatar-xxl">
                        @if(!empty($data->foto))
                            <img class="avatar-img rounded-circle" src="{{ route('user.foto', $data->id) }}" alt="">
                        @else
                            <img class="avatar-img rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="">
                        @endif
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
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Akademik & Arsip</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab-nobd" data-bs-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Data Pembimbingan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab-nobd" data-bs-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Data Arsip</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover table-pembimbingan">
                                <thead>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Tahun Akademik</th>
                                        <th>Semester</th>
                                        <th>Judul Skripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bimbingan as $b)
                                    <tr>
                                        <td>{{ $b->mahasiswa->nama }}</td>
                                        <td>{{ $b->mahasiswa->nik }}</td>
                                        <td>{{ $b->tahun_ajaran->tahun_ajaran }}</td>
                                        <td>{{ $b->semester->semester }}</td>
                                        <td>{{ $b->judul_skripsi }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover table-arsip">
                                <thead>
                                    <tr>
                                        <th>Nama Arsip</th>
                                        <th>File</th>
                                        <th>Sub Kategori Arsip</th>
                                        <th>Tahun Akademik</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($arsip as $a)
                                    <tr>
                                        <td>{{ $a->a_name }}</td>
                                        <td><a href="{{ asset('/file/archives/')."/".$a->a_file }}" target="_blank">{{ $a->a_file }}</a></td>

                                        @if ($a->s_name == '')
                                        <td>-</td>
                                        @else

                                        <td>{{ $a->s_name }}</td>
                                        @endif

                                        <td>{{ $a->ta }}</td>
                                        <td>{{ $a->smt }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection