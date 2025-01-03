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
                            <p class="text-center">Email</p>
                            @if ($data->email != '')
                                <p class="text-center"><b>{{ $data->email }}</b></p>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
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
                        </li>
                    </ul>
                </div>
                <div class="box-footer with-border text-center">
                    {{-- <form action="{{ route('alumni.reset-password', $data->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-flat btn-danger">Reset Password</button>
                    </form> --}}
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Detail Informasi Alumni</h4>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Riwayat Pendidikan</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Pengalaman Pekerjaan</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Kompetensi</a></li>
                            <li><a href="#tab_4" data-toggle="tab">Keahlian</a></li>
                            <li><a href="#tab_5" data-toggle="tab">Media Sosial</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <ul class="list-group list-group-unbordered">
                                    @foreach ($dataPendidikan as $dp)
                                        <li class="list-group-item">
                                            <p><i class="fa fa-tv"></i>&nbsp;<span><b>{{ $dp->program_studi }}</b></span><br></p>
                                            <p><i class="fa fa-building"></i>&nbsp;<span>{{ $dp->perguruan_tinggi }}</span><br></p>
                                            <p><i class="fa fa-calendar-check-o"></i>&nbsp;<span>{{ $dp->angkatan }} - {{ $dp->tahun_lulus }}</span></p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <ul class="list-group list-group-unbordered">
                                    @foreach ($dataPekerjaan as $dpk)
                                        <li class="list-group-item">
                                            @if ($dpk->posisi != '')
                                                <p><i class="fa fa-tag"></i>&nbsp;<span><b>{{ $dpk->posisi }}</b></span><br></p>
                                            @endif
                                            @if ($dpk->nama_perusahaan)
                                                <p><i class="fa fa-building"></i>&nbsp;<span>{{ $dpk->nama_perusahaan }}</span><br></p>
                                            @endif
                                            
                                            <p><i class="fa fa-calendar-check-o"></i>&nbsp;<span>{{ $dpk->tahun_masuk_bekerja }} - {{ $dpk->tahun_berhenti_bekerja }}</span></p>
                                            
                                            @if ($dpk->profesi_id != '')
                                                <p><i class="fa fa-user"></i>&nbsp;<span>{{ $dpk->profesi_alumni->nama_profesi }}</span><br></p>
                                            @endif
                                            @if ($dpk->jabatan_id != '')
                                                <p><i class="fa fa-black-tie"></i>&nbsp;<span>{{ $dpk->jabatan_profesi_alumni->nama_jabatan }}</span><br></p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <ul class="list-group list-group-unbordered">
                                    @foreach ($dataKompetensi as $dk)
                                        <li class="list-group-item">
                                            <p><i class="fa fa-shield"></i>&nbsp;<span><b>{{ $dk->kompetensi }}</b></span><br></p>
                                            <p><i class="fa fa-file-text-o"></i>&nbsp;<a href="{{ url('/alumni/sertifikat', $dk->sertifikat_kompetensi) }}"><i class="fa fa-link"></i>&nbsp;File Sertifikat</a><br></p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <ul class="list-group list-group-unbordered">
                                    @foreach ($dataKeahlian as $dkh)
                                        <li class="list-group-item">
                                            <p><i class="fa fa-wrench"></i>&nbsp;<span><b>{{ $dkh->keahlian }}</b></span><br></p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="tab_5">
                                <ul class="list-group list-group-unbordered">
                                    @if (is_null($dataMedsos))
                                        <li class="list-group-item">
                                            <p><i class="fa fa-linkedin-square"></i>&nbsp;<span><b>Linked In</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;-<br></p>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <p><i class="fa fa-linkedin-square"></i>&nbsp;<span><b>Linked In</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;{{ $dataMedsos->link_linkedin }}<br></p>
                                        </li>
                                    @endif
                                    @if (is_null($dataMedsos))
                                        <li class="list-group-item">
                                            <p><i class="fa fa-instagram"></i>&nbsp;<span><b>Instagram</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;-<br></p>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <p><i class="fa fa-instagram"></i>&nbsp;<span><b>Instagram</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;{{ $dataMedsos->link_instagram }}<br></p>
                                        </li>
                                    @endif
                                    @if (is_null($dataMedsos))
                                        <li class="list-group-item">
                                            <p><i class="fa fa-facebook-square"></i>&nbsp;<span><b>Facebook</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;-<br></p>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <p><i class="fa fa-facebook-square"></i>&nbsp;<span><b>Facebook</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;{{ $dataMedsos->link_facebook }}<br></p>
                                        </li>
                                    @endif
                                    @if (is_null($dataMedsos))
                                        <li class="list-group-item">
                                            <p><i class="fa fa-twitter-square"></i>&nbsp;<span><b>Twitter X</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;-<br></p>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <p><i class="fa fa-twitter-square"></i>&nbsp;<span><b>Twitter X</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;{{ $dataMedsos->link_twitter }}<br></p>
                                        </li>
                                    @endif
                                    @if (is_null($dataMedsos))
                                        <li class="list-group-item">
                                            <p><i class="fa fa-youtube-play"></i>&nbsp;<span><b>Youtube</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;-<br></p>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <p><i class="fa fa-youtube-play"></i>&nbsp;<span><b>Youtube</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;{{ $dataMedsos->link_youtube }}<br></p>
                                        </li>
                                    @endif
                                    @if (is_null($dataMedsos))
                                        <li class="list-group-item">
                                            <p><i class="fa fa-globe"></i>&nbsp;<span><b>Personal Website</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;-<br></p>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <p><i class="fa fa-globe"></i>&nbsp;<span><b>Personal Website</b></span><br></p>
                                            <p><i class="fa fa-link"></i>&nbsp;&nbsp;{{ $dataMedsos->link_website }}<br></p>
                                        </li>
                                    @endif
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection