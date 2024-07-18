@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Detail Kegiatan SKKFT</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Kegiatan SKKFT</h3>
                </div>
                <div class="box-body">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nama Kegiatan</b> <p class="pull-right">{{ $kegiatan->nama_kegiatan }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Kegiatan</b> <p class="pull-right">{{ tanggal_indonesia($kegiatan->tanggal) }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Kategori</b> <p class="pull-right">{{ $kegiatan->categories_skkft->category_name }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Sub Kategori</b> <p class="pull-right">{{ $kegiatan->subcategories_skkft->subcategory_name }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tingkat</b> 
                            @if ($kegiatan->tingkat_id != '')
                                <p class="pull-right">{{ $kegiatan->tingkat_skkft->tingkat }}</p>
                            @else
                            <p class="pull-right">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Prestasi</b> 
                            @if ($kegiatan->prestasi_id != '')
                                <p class="pull-right">{{ $kegiatan->prestasi_skkft->prestasi }}</p>
                            @else
                            <p class="pull-right">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Jabatan</b> 
                            @if ($kegiatan->jabatan_id != '')
                                <p class="pull-right">{{ $kegiatan->jabatan_skkft->jabatan }}</p>
                            @else
                            <p class="pull-right">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Bukti Fisik</b><a href="{{ url('/mahasiswa/skkft', $kegiatan->bukti_fisik) }}" class="pull-right">{{ $kegiatan->bukti_fisik }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Status SKKFT</b> 
                            @if ($kegiatan->status_skkft == 0)
                                <p class="pull-right"><span class="label bg-yellow text-black">Menunggu Verifikasi</span></p>
                            @elseif ($kegiatan->status_skkft == 1)
                                <p class="pull-right"><span class="label bg-green">Diterima</span></p>
                            @else
                            <p class="pull-right"><span class="label bg-red">Ditolak</span></p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Status SKPI</b> 
                            @if ($kegiatan->status_skpi == 0)
                                <p class="pull-right"><span class="label bg-yellow text-black">Menunggu Verifikasi</span></p>
                            @elseif ($kegiatan->status_skpi == 1)
                                <p class="pull-right"><span class="label bg-green">Ya</span></p>
                            @else
                            <p class="pull-right"><span class="label bg-red">Tidak</span></p>
                            @endif
                        </li>
                        @if ($kegiatan->keterangan != '')
                            <p class="pull-right">{{ $kegiatan->keterangan }}</p>
                        @endif
                    </ul>
                </div>
                <div class="box-footer with-border">
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-backward"></i> Kembali</a>
                </div>
            </div>
        </div>
        {{-- <div class="col-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Kegiatan SKKFT</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-tag margin-r-5"></i> Nama Kegiatan</strong>
                    <p class="text-muted">{{ $kegiatan->nama_kegiatan }}</p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Tanggal Kegiatan</strong>
                    <p class="text-muted">{{ tanggal_indonesia($kegiatan->tanggal) }}</p>
                    <hr>
                    <strong><i class="fa fa-folder margin-r-5"></i> Kategori</strong>
                    <p class="text-muted">{{ $kegiatan->categories_skkft->category_name }}</p>
                    <hr>
                    <strong><i class="fa fa-cube margin-r-5"></i> Sub Kategori</strong>
                    <p class="text-muted">{{ $kegiatan->subcategories_skkft->subcategory_name }}</p>
                    <hr>
                    <strong><i class="fa fa-navicon margin-r-5"></i> Tingkat</strong>
                    @if ($kegiatan->tingkat_id != '')
                    <p class="text-muted"></p>
                    @else
                    <p>-</p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-hourglass margin-r-5"></i> Prestasi</strong>
                    @if ($kegiatan->prestasi_id != '')
                    <p class="text-muted">{{ $kegiatan->prestasi_skkft->prestasi }}</p>
                    @else
                    <p>-</p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-hourglass-end margin-r-5"></i> Jabatan</strong>
                    @if ($kegiatan->jabatan_id != '')
                    <p class="text-muted">{{ $kegiatan->jabatan_skkft->jabatan }}</p>
                    @else
                    <p>-</p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-hourglass-end margin-r-5"></i> Bukti Fisik</strong>
                    <p class="text-muted"><a href="{{ url('/mahasiswa/skkft', $kegiatan->bukti_fisik) }}" target="_blank">{{ $kegiatan->bukti_fisik }}</a></p>
                    <hr>
                </div>
            </div>
        </div> --}}
    </div>
</section>

@endsection

@push('scripts_page')

@endpush