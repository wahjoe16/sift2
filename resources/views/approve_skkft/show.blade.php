@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Detail Kegiatan SKKFT</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-post card-round">
            <img class="card-img-top" src="{{ asset('/media/unisba.JPG') }}" alt="Card image cap" />
            <div class="card-body">
                <div class="d-flex">
                    <div class="avatar avatar-xl">
                        <img src="{{ route('user.foto', $data->user_skkft->id) }}" alt="..." class="avatar-img rounded-circle" />
                    </div>
                    <div class="info-post ms-2">
                        <p class="username">{{ $data->user_skkft->nama }}</p>
                        <p class="date text-muted">{{ $data->user_skkft->nik }}</p>
                    </div>
                </div>

                <div class="separator-solid"></div>
                <h3 class="card-title">Program Studi</h3>
                <p class="card-text">{{ $data->user_skkft->program_studi }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Email</h3>
                <p class="card-text">{{ $data->user_skkft->email }}</p>
                
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Informasi Kegiatan SKKFT</h4>
            </div>
            <div class="card-body">
                <h3 class="card-title">Nama Kegiatan</h3>
                <p class="card-text">{{ $data->nama_kegiatan }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tanggal Kegiatan</h3>
                <p class="card-text">{{ tanggal_indonesia($data->tanggal) }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tanggal Pengajuan</h3>
                <p class="card-text">{{ tanggal_indonesia($data->created_at) }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Kategori</h3>
                <p class="card-text">{{ $data->categories_skkft->category_name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Sub Kategori</h3>
                <p class="card-text">{{ $data->subcategories_skkft->subcategory_name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tingkat</h3>
                <p class="card-text">
                    @if ($data->tingkat_id != '')
                        {{ $data->tingkat_skkft->tingkat }}
                    @else
                    -
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Prestasi</h3>
                <p class="card-text">
                    @if ($data->prestasi_id != '')
                        {{ $data->prestasi_skkft->prestasi }}
                    @else
                    -
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Jabatan</h3>
                <p class="card-text">
                    @if ($data->jabatan_id != '')
                        {{ $data->jabatan_skkft->jabatan }}
                    @else
                    -
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Bukti Fisik</h3>
                <p class="card-text">
                    <a href="{{ asset('storage/' . $data->bukti_fisik) }}">{{ $data->bukti_fisik }}</a>
                    {{-- <a href="{{ url('/mahasiswa/skkft', $data->bukti_fisik) }}">{{ $data->bukti_fisik }}</a> --}}
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Poin</h3>
                <p class="card-text">{{ $data->point }}</p>
            </div>
        </div>
    </div>
</div>

@endsection