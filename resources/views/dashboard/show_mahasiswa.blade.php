@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Detail Profil {{ $data->nama }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{ID USER {{ $data->id }}}</h3>
    </div>
</div>

@includeIf('layouts.alert')

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
                        {{-- <img src="{{ asset('/user/foto/' . $data->foto) }}" alt="..." class="avatar-img rounded-circle" /> --}}
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
                <h4 class="card-title">Data Akademik & Kemahasiswaan</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab-nobd" data-bs-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Data Sidang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab-nobd" data-bs-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Data SKKFT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-rekap-tab-nobd" data-bs-toggle="pill" href="#pills-rekap-nobd" role="tab" aria-controls="pills-rekap-nobd" aria-selected="false">Rekap SKKFT</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                        <div class="card card-pricing">
                            <div class="card-body">
                                <ul class="specification-list">
                                    <li>
                                        <span class="name-specification">Tahun Akademik</span>
                                        <span class="status-specification">
                                            @if (is_null($sidang))
                                            <b> - </b>
                                            @else
                                            <b>{{ $sidang->tahun_ajaran->tahun_ajaran }}</b>
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Semester</span>
                                        <span class="status-specification">
                                            @if (is_null($sidang))
                                            <b> - </b>
                                            @else
                                            <b>{{ $sidang->semester->semester }}</b>
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Dosen Pembimbing 1</span>
                                        <span class="status-specification">
                                             @if (is_null($sidang))
                                            <b> - </b>
                                            @else
                                            <b>{{ $sidang->dosen_1->nama }}</b>
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Dosen Pembimbing 2</span>
                                        <span class="status-specification">
                                            @if (is_null($sidang))
                                            <b> - </b>
                                            @elseif (is_null($sidang->dosen_2))
                                            <b>-</b>
                                            @else
                                            <b>{{ $sidang->dosen_2->nama }}</b>
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Judul Skripsi</span>
                                        <span class="status-specification">
                                            @if (is_null($sidang))
                                            <b> - </b>
                                            @else
                                            <b>{{ $sidang->judul_skripsi }}</b>
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Tanggal Pengajuan</span>
                                        <span class="status-specification">
                                            @if (is_null($sidang))
                                            <b> - </b>
                                            @else
                                            <b>{{ tanggal_indonesia($sidang->created_at) }}</b>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover table-kegiatan_skkft">
                                <thead>
                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <th>Kategori</th>
                                        <th>Subkategori</th>
                                        <th>Poin</th>
                                        <th>Status SKKFT</th>
                                        <th><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <th>Kategori</th>
                                        <th>Subkategori</th>
                                        <th>Poin</th>
                                        <th>Status SKKFT</th>
                                        <th><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($kegiatan as $k)
                                    <tr>
                                        <td>{{ $k->nama_kegiatan }}</td>
                                        <td>{{$k->categories_skkft->category_name}}</td>
                                        <td>{{$k->subcategories_skkft->subcategory_name}}</td>
                                        
                                        @if ($k->point != '')
                                            <td>{{ $k->point }}</td>
                                            @else
                                            <td>-</td>
                                        @endif
                                        @if ($k->status_skkft == 0)
                                            <td><span class="badge badge-warning text-black">Menunggu</span></td>
                                            @elseif ($k->status_skkft == 1)
                                            <td><span class="badge badge-success">Diterima</span></td>
                                            @elseif ($k->status_skkft == 2)
                                            <td><span class="badge badge-danger">Ditolak</span></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('skkft.show', $k->id) }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-search"></i></a>
                                            <form action="{{ route('approveKegiatan.destroy', $k->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-dismissible">
                                        <h4><i class="icon fas fa-warning"></i> Perhatian!</h4>
                                        Jika sebelumnya sudah memiliki riwayat poin kegiatan SKKFT, silahkan klik <a href="{{ route('kegiatan.recovery', $data->id) }}">Disini </a>untuk memulihkan data kegiatan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-rekap-nobd" role="tabpanel" aria-labelledby="pills-rekap-tab-nobd">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover table-rekap_skkft">
                                <thead>
                                    <th width="5%">#</th>
                                    <th class="text-center">Kategori</th>
                                    <th width="12%">Poin</th>
                                    <th width="40%" class="text-center">Keterangan</th>
                                </thead>
                                <tbody>
                                    @foreach ($poinKategori as $pk)
                                        <tr>
                                            <td>{{ $pk['id'] }}</td>
                                            <td>{{ $pk['category'] }}</td>
                                            <td>{{ $pk['poin'] }}</td>
                                            <td>
                                                @if ($pk['lolos'])
                                                    <div class="alert alert-success alert-dismissible">
                                                        Poin Sudah Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                                    </div>
                                                    @else
                                                    <div class="alert alert-warning alert-dismissible">
                                                        Poin Belum Mencapai Bobot Minimal ({{$pk['bobotnya']}}% Dari 150 Poin)
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td class="text-right" colspan="2"><b>Total Poin</b></td>
                                            <td colspan="2"><b>{{ $totalPoin }}</b></td>
                                        </tr>
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