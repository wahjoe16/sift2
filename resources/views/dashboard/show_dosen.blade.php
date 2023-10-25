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
                    <h4>Informasi Dosen</h4>
                </div>
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
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
                                    <p class="text-center">Tipe Dosen</p>
                                    <p class="text-center"><b>{{ $data->tipe_dosen }}</b></p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Pembimbingan</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Data Arsip Fakultas</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <table class="table table-striped table-bordered table-dashboard-bimbingan">
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
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <table class="table table-striped table-bordered table-dashboard-arsip">
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
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection