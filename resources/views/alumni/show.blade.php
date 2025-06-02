@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Detail Profil {{ $data->nama }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{ID USER {{ $data->id }}}</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
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
                    <div class="job">{{ $data->email }}</div>
                    <div class="desc">{{ $data->alamat }}</div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Detail Informasi Alumni</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-pendidikan-tab-nobd" data-bs-toggle="pill" href="#pills-pendidikan-nobd" role="tab" aria-controls="pills-pendidikan-nobd" aria-selected="true">Riwayat Pendidikan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-pekerjaan-tab-nobd" data-bs-toggle="pill" href="#pills-pekerjaan-nobd" role="tab" aria-controls="pills-pekerjaan-nobd" aria-selected="false">Pengalaman Pekerjaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-kompetensi-tab-nobd" data-bs-toggle="pill" href="#pills-kompetensi-nobd" role="tab" aria-controls="pills-kompetensi-nobd" aria-selected="false">Kompetensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-keahlian-tab-nobd" data-bs-toggle="pill" href="#pills-keahlian-nobd" role="tab" aria-controls="pills-keahlian-nobd" aria-selected="false">Keahlian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-medsos-tab-nobd" data-bs-toggle="pill" href="#pills-medsos-nobd" role="tab" aria-controls="pills-medsos-nobd" aria-selected="false">Media Sosial</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-pendidikan-nobd" role="tabpanel" aria-labelledby="pills-pendidikan-tab-nobd">
                        <ul class="list-group list-group-unbordered">
                            @foreach ($dataPendidikan as $dp)
                                <div class="separator-solid"></div>
                                <h5 class="card-title"><i class="fas fa-tv"></i>&nbsp;{{ $dp->program_studi }}</h5>
                                <p class="card-text"><i class="fas fa-building"></i>&nbsp;{{ $dp->perguruan_tinggi }}</p>
                                <p class="card-text"><i class="fas fa-calendar-check"></i>&nbsp;{{ $dp->angkatan }} - {{ $dp->tahun_lulus }}</p>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-pekerjaan-nobd" role="tabpanel" aria-labelledby="pills-pekerjaan-tab-nobd">
                        @foreach ($dataPekerjaan as $dpk)
                            <div class="separator-solid"></div>
                                @if ($dpk->posisi != '')
                                    <h5 class="card-title"><i class="fas fa-tag"></i>&nbsp;{{ $dpk->posisi }}</h5>
                                @endif
                                @if ($dpk->nama_perusahaan)
                                    <p class="card-text"><i class="fas fa-building"></i>&nbsp;<span>{{ $dpk->nama_perusahaan }}</span><br></p>
                                @endif
                                
                                <p class="card-text"><i class="fas fa-calendar-check"></i>&nbsp;<span>{{ $dpk->tahun_masuk_bekerja }} - {{ $dpk->tahun_berhenti_bekerja }}</span></p>
                                
                                @if ($dpk->profesi_id != '')
                                    <p class="card-text"><i class="fas fa-user-tie"></i>&nbsp;<span>{{ $dpk->profesi_alumni->nama_profesi }}</span><br></p>
                                @endif
                                @if ($dpk->jabatan_id != '')
                                    <p class="card-text"><i class="fas fa-user-cog"></i>&nbsp;<span>{{ $dpk->jabatan_profesi_alumni->nama_jabatan }}</span><br></p>
                                @endif
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="pills-kompetensi-nobd" role="tabpanel" aria-labelledby="pills-kompetensi-tab-nobd">
                        @foreach ($dataKompetensi as $dk)
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fas fa-shield"></i>&nbsp;{{ $dk->kompetensi }}</h5>
                            <p class="card-text"><i class="fas fa-file-text"></i>&nbsp;<a href="{{ url('/alumni/sertifikat', $dk->sertifikat_kompetensi) }}"><i class="fa fa-link"></i>&nbsp;File Sertifikat</a></p>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="pills-keahlian-nobd" role="tabpanel" aria-labelledby="pills-keahlian-tab-nobd">
                        @foreach ($dataKeahlian as $dkh)
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fas fa-wrench"></i>&nbsp;{{ $dkh->keahlian }}</h5>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="pills-medsos-nobd" role="tabpanel" aria-labelledby="pills-medsos-tab-nobd">
                        @if (is_null($dataMedsos))
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-linkedin"></i>&nbsp;Linked In</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>-</span><br></p>
                        @else
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-linkedin"></i>&nbsp;Linked In</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>{{ $dataMedsos->link_linkedin }}</span><br></p>
                        @endif

                        @if (is_null($dataMedsos))
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-instagram"></i>&nbsp;Instagram</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>-</span><br></p>
                        @else
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-instagram"></i>&nbsp;Instagram</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>{{ $dataMedsos->link_instagram }}</span><br></p>
                        @endif

                        @if (is_null($dataMedsos))
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-facebook"></i>&nbsp;Facebook</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>-</span><br></p>
                        @else
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-facebook"></i>&nbsp;Facebook</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>{{ $dataMedsos->link_facebook }}</span><br></p>
                        @endif

                        @if (is_null($dataMedsos))
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-twitter-square"></i>&nbsp;Twitter X</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>-</span><br></p>
                        @else
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-twitter-square"></i>&nbsp;Twitter X</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>{{ $dataMedsos->link_twitter }}</span><br></p>
                        @endif

                        @if (is_null($dataMedsos))
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-youtube"></i>&nbsp;Youtube</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>-</span><br></p>
                        @else
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fab fa-youtube"></i>&nbsp;Youtube</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>{{ $dataMedsos->link_youtube }}</span><br></p>
                        @endif

                        @if (is_null($dataMedsos))
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fas fa-globe"></i>&nbsp;Personal Website</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>-</span><br></p>
                        @else
                            <div class="separator-solid"></div>
                            <h5 class="card-title"><i class="fas fa-globe"></i>&nbsp;Personal Website</h5>
                            <p class="card-text"><i class="fas fa-link"></i>&nbsp;<span>{{ $dataMedsos->link_website }}</span><br></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection