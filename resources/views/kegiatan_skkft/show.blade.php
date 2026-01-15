@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Detail Kegiatan SKKFT</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Informasi Kegiatan</h5>
            </div>
            <div class="card-body">
                <h3 class="card-title">Nama Kegiatan</h3>
                <p class="card-text">{{ $kegiatan->nama_kegiatan }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tanggal Kegiatan</h3>
                <p class="card-text">{{ tanggal_indonesia($kegiatan->tanggal) }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tanggal Pengajuan</h3>
                <p class="card-text">{{ tanggal_indonesia($kegiatan->created_at) }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Bukti Fisik</h3>
                <p class="card-text"><a href="{{ asset('storage/' . $kegiatan->bukti_fisik) }}">{{ $kegiatan->bukti_fisik }}</a></p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Status SKKFT</h3>
                <p class="card-text">
                    @if ($kegiatan->status_skkft == 0)
                        <button type="button" class="btn btn-icon btn-round btn-warning">
                            <i class="fa fa-exclamation-circle"></i>
                        </button>&nbsp;Menunggu Approval
                    @elseif ($kegiatan->status_skkft == 1)
                        <button type="button" class="btn btn-icon btn-round btn-success">
                            <i class="fa fa-check"></i>
                        </button>&nbsp;Diterima
                    @else
                        <button type="button" class="btn btn-icon btn-round btn-danger">
                            <i class="fa fa-xmark"></i>
                        </button>&nbsp;Ditolak
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Status SKPI</h3>
                <p class="card-text">
                    @if ($kegiatan->status_skpi == 0)
                        <button type="button" class="btn btn-icon btn-round btn-warning">
                            <i class="fa fa-exclamation-circle"></i>
                        </button>&nbsp;Menunggu Approval
                    @elseif ($kegiatan->status_skpi == 1)
                        <button type="button" class="btn btn-icon btn-round btn-success">
                            <i class="fa fa-check"></i>
                        </button>&nbsp;Diterima
                    @else
                        <button type="button" class="btn btn-icon btn-round btn-danger">
                            <i class="fa fa-xmark"></i>
                        </button>&nbsp;Ditolak
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Keterangan</h3>
                <p class="card-text">{{ $kegiatan->keterangan }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Kategori Kegiatan</h5>
            </div>
            <div class="card-body">
                <h3 class="card-title">Kategori</h3>
                <p class="card-text">{{ $kegiatan->categories_skkft->category_name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Sub Kategori</h3>
                <p class="card-text">{{ $kegiatan->subcategories_skkft->subcategory_name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tingkat</h3>
                <p class="card-text">
                    @if ($kegiatan->tingkat_id != '')
                        {{ $kegiatan->tingkat_skkft->tingkat }}
                    @else
                    -
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Prestasi</h3>
                <p class="card-text">
                    @if ($kegiatan->prestasi_id != '')
                        {{ $kegiatan->prestasi_skkft->prestasi }}
                    @else
                    -
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Jabatan</h3>
                <p class="card-text">
                    @if ($kegiatan->jabatan_id != '')
                        {{ $kegiatan->jabatan_skkft->jabatan }}
                    @else
                    -
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

@endsection