@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Approval Kegiatan SKKFT</h3>
    </div>
</div>

@include('layouts.alert')

<form action="{{ route('approveKegiatan.update', $dataPengajuan->id) }}" class="form-horizontal" method="post">@csrf
    <div class="row">
        <div class="col-md-4">
            <div class="card card-post card-round">
                <img class="card-img-top" src="{{ asset('/media/unisba.JPG') }}" alt="Card image cap" />
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar avatar-xl">
                            <img src="{{ route('user.foto', $dataPengajuan->user_skkft->id) }}" alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <div class="info-post ms-2">
                            <p class="username">{{ $dataPengajuan->user_skkft->nama }}</p>
                            <p class="date text-muted">{{ $dataPengajuan->user_skkft->nik }}</p>
                        </div>
                    </div>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Program Studi</h3>
                    <p class="card-text">{{ $dataPengajuan->user_skkft->program_studi }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Email</h3>
                    <p class="card-text">{{ $dataPengajuan->user_skkft->email }}</p>
                    
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Kegiatan SKKFT</h5>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Nama Kegiatan</h3>
                    <p class="card-text">{{ $dataPengajuan->nama_kegiatan }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Tanggal Kegiatan</h3>
                    <p class="card-text">{{ tanggal_indonesia($dataPengajuan->tanggal) }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Tanggal Pengajuan</h3>
                    <p class="card-text">{{ tanggal_indonesia($dataPengajuan->created_at) }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Kategori</h3>
                    <p class="card-text">{{ $dataPengajuan->categories_skkft->category_name }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Sub Kategori</h3>
                    <p class="card-text">{{ $dataPengajuan->subcategories_skkft->subcategory_name }}</p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Tingkat</h3>
                    <p class="card-text">
                        @if ($dataPengajuan->tingkat_id != '')
                            {{ $dataPengajuan->tingkat_skkft->tingkat }}
                        @else
                        -
                        @endif
                    </p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Prestasi</h3>
                    <p class="card-text">
                        @if ($dataPengajuan->prestasi_id != '')
                            {{ $dataPengajuan->prestasi_skkft->prestasi }}
                        @else
                        -
                        @endif
                    </p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Jabatan</h3>
                    <p class="card-text">
                        @if ($dataPengajuan->jabatan_id != '')
                            {{ $dataPengajuan->jabatan_skkft->jabatan }}
                        @else
                        -
                        @endif
                    </p>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Bukti Fisik</h3>
                    <p class="card-text">
                        <a href="{{ asset('storage/' . $dataPengajuan->bukti_fisik) }}">{{ $dataPengajuan->bukti_fisik }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Approval SKKFT</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="status_skkft">Status SKKFT</label>
                        <select class="form-control" id="status_skkft" name="status_skkft">
                            <option value="">-- Pilih --</option>
                            <option value="1" @if($dataPengajuan->status == 1) selected @endif>Diterima</option>
                            <option value="2" @if($dataPengajuan->status == 2) selected @endif>Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputError" class="col-lg-2">Keterangan</label>
                        <textarea name="keterangan" id="inputError" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Masukan Keterangan"></textarea>
                        @error('keterangan') <span class="help-block">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_skpi" class="col-lg-2">Status SKPI</label>
                        <div class="col-sm-6">
                            <input type="checkbox" name="status_skpi" value="1" @if($dataPengajuan->status_skpi == 1) checked @endif>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="btn-groups">
            <button type="submit" class="btn btn-info mr-2">Simpan</button>
            <a href="{{ route('dashboardSkkft.index') }}" class="btn btn-light">Batal</a>
        </div>
    </div>
</form>

@endsection
