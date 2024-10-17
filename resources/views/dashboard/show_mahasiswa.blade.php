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
                    <h4>Informasi Mahasiswa</h4>
                </div>
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $data->foto) }}" alt="">
                            <h3 class="profile-username text-center">{{ $data->nama }}</h3>
                            <p class="text-muted text-center">{{ $data->nik }}</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <p class="text-center">ID</p>
                                    <p class="text-center"><b>{{ $data->id }}</b></p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-center">Program Studi</p>
                                    <p class="text-center"><b>{{ $data->program_studi }}</b></p>
                                </li>
                                <li class="list-group-item">
                                    <p class="text-center">Email</p>
                                    <p class="text-center"><b>{{ $data->email }}</b></p>
                                </li>
                                @if (!is_null($data->tanggal_lahir))
                                    <li class="list-group-item">
                                        <p class="text-center">Tempat dan Tanggal Lahir</p>
                                        <p class="text-center"><b>{{ $data->tempat_lahir }}, {{ tanggal_indonesia($data->tanggal_lahir, false) }}</b></p>
                                    </li>
                                @endif
                                
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Sidang</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Data Kemahasiswaan (SKKFT)</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Rekap Data SKKFT</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <p>Tahun Akademik</p>
                                                @if (is_null($sidang))
                                                <b> - </b>
                                                @else
                                                <b>{{ $sidang->tahun_ajaran->tahun_ajaran }}</b>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                <p>Semester</p>
                                                @if (is_null($sidang))
                                                <b> - </b>
                                                @else
                                                <b>{{ $sidang->semester->semester }}</b>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                <p>Dosen Pembimbing 1</p>
                                                @if (is_null($sidang))
                                                <b> - </b>
                                                @else
                                                <b>{{ $sidang->dosen_1->nama }}</b>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                <p>Dosen Pembimbing 2</p>
                                                @if (is_null($sidang))
                                                <b> - </b>
                                                @elseif (is_null($sidang->dosen_2))
                                                <b>-</b>
                                                @else
                                                <b>{{ $sidang->dosen_2->nama }}</b>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                <p>Judul Skripsi</p>
                                                @if (is_null($sidang))
                                                <b> - </b>
                                                @else
                                                <b>{{ $sidang->judul_skripsi }}</b>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                <p>Tanggal Pengajuan</p>
                                                @if (is_null($sidang))
                                                <b> - </b>
                                                @else
                                                <b>{{ tanggal_indonesia($sidang->created_at) }}</b>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <table class="table table-striped table-bordered table-kegiatan_skkft">
                                            <thead>
                                                <th width="5%">No</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Kategori</th>
                                                <th>Subkategori</th>
                                                <th>Poin</th>
                                                <th>Status SKKFT</th>
                                                <th width="5%"><i class="fa fa-cogs"></i> Aksi</th>
                                            </thead>
                                            <tbody>
                                                @foreach($kegiatan as $k)
                                                <tr>
                                                    <td>{{$loop->index + 1}}</td>
                                                    <td>{{ $k->nama_kegiatan }}</td>
                                                    <td>{{$k->categories_skkft->category_name}}</td>
                                                    <td>{{$k->subcategories_skkft->subcategory_name}}</td>
                                                    
                                                    @if ($k->point != '')
                                                        <td>{{ $k->point }}</td>
                                                        @else
                                                        <td>-</td>
                                                    @endif
                                                    @if ($k->status_skkft == 0)
                                                        <td><span class="label bg-yellow text-black">Menunggu</span></td>
                                                        @elseif ($k->status_skkft == 1)
                                                        <td><span class="label bg-green">Diterima</span></td>
                                                        @elseif ($k->status_skkft == 2)
                                                        <td><span class="label bg-red">Ditolak</span></td>
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
                                                    <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                                                    Jika sebelumnya sudah memiliki riwayat poin kegiatan SKKFT, silahkan klik <a href="{{ route('kegiatan.recovery', $data->id) }}">Disini </a>untuk memulihkan data kegiatan.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h4><i>Summary</i> SKKFT <strong>{{ $data->nama }}</strong></h4>
                                                    </div>
                                                    <div class="box-body table-responsive">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <table class="table table-striped table-bordered">
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