@extends('layouts.portal.master')

@section('content')

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card" style="height: 400px;">
            {{-- @if (empty($profilLulusan))
                <img src="{{ url('/media/scotland.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 200px; object-fit:cover;"> 
            @elseif ($profilLulusan->jenjang == 'S1' && $profilLulusan->program_studi == 'Teknik Pertambangan')
                <img src="{{ url('/media/mining.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 200px; object-fit:cover;">
            @elseif ($profilLulusan->jenjang == 'S1' && $profilLulusan->program_studi == 'Teknik Industri')
                <img src="{{ url('/media/industry.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 200px;">
            @elseif ($profilLulusan->jenjang == 'S1' && $profilLulusan->program_studi == 'Perencanaan Wilayah dan Kota')
                <img src="{{ url('/media/pwk.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 200px;">
            @endif --}}
            @if (!empty($dataAlumni->banner_img))
                <img src="{{ url('/user/banner/', $dataAlumni->banner_img) }}" class="card-img-top" alt="..." style="max-width: 100%; height: 200px; object-fit: cover;">
            @else
                <img src="{{ url('/media/banneralumni.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 200px; object-fit: cover;">
            @endif
             
            <div class="card-body">
                @if (!empty($data->foto))
                    <img src="{{ url('/user/foto', $data->foto) }}" alt="" class="rounded-circle foto-friend" style="position: relative; top: -68px; left: 20px;">
                @else
                    <img class="rounded-circle foto-friend" src="{{ asset('user/foto/user.png') }}" alt="" style="position: relative; top: -68px; left: 20px;">
                @endif
                
                <p class="card-text" style="font-size: 28px; font-weight: 500; position:relative; top: -85px; left:20px;">{{ $data->nama }}</p></a>
                <p class="card-text mb-3" style="color: grey; font-size: 17px; font-weight: 300; position:relative; top: -100px; left:20px;">{{ $dataAlumni->pekerjaan_sekarang }}</p>
                <div style="position:relative; top: -100px; left:20px;">
                    <span>
                        <i class="bi bi-envelope"></i> {{ $data->email }}&nbsp;&nbsp;
                        @if ($dataAlumni->allow_view_no_hp == 1)
                            <i class="bi bi-phone"></i> {{ $dataAlumni->no_hp }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h4><i class="bi bi-suitcase-lg icon-menu-profile" style="color: #fc4e03;"></i>&nbsp;&nbsp;Pengalaman Bekerja</h4>
                <ul class="list-group list-group-flush">
                    @foreach ($riwayatKerja as $rk)
                        <li class="list-group-item" style="margin-left: 35px;">
                            <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-circle"></i>&nbsp;&nbsp;{{ $rk->posisi }}</p>
                            <p class="card-text" style="font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px;">{{ $rk->nama_perusahaan }}</p>
                            <p class="card-text" style="color: grey; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px;">{{ $rk->tahun_masuk_bekerja }} - {{ $rk->tahun_berhenti_bekerja }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h4><i class="bi bi-mortarboard  icon-menu-profile" style="color: #0317fc"></i>&nbsp;&nbsp;Pendidikan</h4>
                <ul class="list-group list-group-flush">
                    @foreach ($pendidikan as $p)
                        <li class="list-group-item" style="margin-left: 35px;">
                            <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-bank"></i>&nbsp;&nbsp;{{ $p->perguruan_tinggi }}</p>
                            <p class="card-text" style="font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px">{{ $p->jenjang }}, {{ $p->program_studi }}</p>
                            <p class="card-text" style="color: grey; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px">{{ $p->angkatan }} - {{ $p->tahun_lulus }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h4><i class="bi bi-shield-fill-plus icon-menu-profile" style="color: #87036f;"></i>&nbsp;&nbsp;Sertifikasi Kompetensi</h4>
                <ul class="list-group list-group-flush">
                    @foreach ($kompetensi as $k)
                        <li class="list-group-item" style="margin-left: 35px;">
                            <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-card-list"></i>&nbsp;&nbsp;{{ $k->kompetensi }}</p>
                            <p class="card-text" style="color: white; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px""><a class="btn btn-info btn-sm" href="{{ url('/alumni/sertifikat/', $k->sertifikat_kompetensi) }}"><i class="bi bi-link-45deg"></i> Lihat Sertifikat</a></p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h4><i class="bi bi-wrench-adjustable icon-menu-profile" style="color: #04d4c6;"></i>&nbsp;&nbsp;Keahlian</h4>
                <ul class="list-group list-group-flush">
                    @foreach ($keahlian as $kh)
                        <li class="list-group-item" style="margin-left: 35px;">
                            <p class="card-text mt-3" style="font-size: 18px; font-weight: 300;"><i class="bi bi-check-square"></i>&nbsp;&nbsp;{{ $kh->keahlian }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Aktivitas</h5>
                @foreach ($postingan as $p)
                    <div class="card feeds-card-profile">
                        <div class="card-header feed-header-profile">
                            <img src="{{ url('/user/foto', $p['users']['foto']) }}" class="float-start" alt="">
                            <p>{{ $p['users']['nama'] }}</p>
                            <p><small class="text-body-secondary">{{ tanggal_indonesia($p['created_at'], false) }}</small></p>
                        </div>
                        <div class="card-body feed-body-profile">
                            <?php $paragraphs = explode(PHP_EOL, $p['deskripsi']); ?>

                            @foreach ($paragraphs as $paragraph)
                                <p>{{{ $paragraph }}}</p>
                            @endforeach
                            
                        </div>
                        @if (!is_null($p['media']))
                            <img src="{{ url('/alumni/postingan', $p['media']) }}" class="card-img-bottom img-card" alt="...">
                        @endif
                        
                    </div>
                @endforeach
            </div>
    
        </div>
    </div>
</div>

@endsection