@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<section class="content-header">
    <h3>Approval Kegiatan SKKFT</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <form action="{{ route('approveKegiatan.update', $dataPengajuan->id) }}" class="form-horizontal" method="post">@csrf
        <div class="row">
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Mahasiswa</h3>
                    </div>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $dataPengajuan->user_skkft->foto) }}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{ $dataPengajuan->user_skkft->nama }}</h3>
                        <p class="text-muted text-center">{{ $dataPengajuan->user_skkft->nik }}</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <p>Program Studi</p>
                                <b>{{ $dataPengajuan->user_skkft->program_studi }}</b>
                            </li>
                            <li class="list-group-item">
                                <p>Email</p>
                                <b>{{ $dataPengajuan->user_skkft->email }}</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Kegiatan SKKFT</h3>
                    </div>
                    <div class="box-body">
                        <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nama Kegiatan</b> <p>{{ $dataPengajuan->nama_kegiatan }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Kegiatan</b> <p class="pull-right">{{ tanggal_indonesia($dataPengajuan->tanggal) }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Pengajuan</b> <p class="pull-right">{{ tanggal_indonesia($dataPengajuan->created_at) }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Kategori</b> <p class="pull-right">{{ $dataPengajuan->categories_skkft->category_name }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Sub Kategori</b> <p class="pull-right">{{ $dataPengajuan->subcategories_skkft->subcategory_name }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tingkat</b> 
                            @if ($dataPengajuan->tingkat_id != '')
                                <p class="pull-right">{{ $dataPengajuan->tingkat_skkft->tingkat }}</p>
                            @else
                            <p class="pull-right">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Prestasi</b> 
                            @if ($dataPengajuan->prestasi_id != '')
                                <p class="pull-right">{{ $dataPengajuan->prestasi_skkft->prestasi }}</p>
                            @else
                            <p class="pull-right">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Jabatan</b> 
                            @if ($dataPengajuan->jabatan_id != '')
                                <p class="pull-right">{{ $dataPengajuan->jabatan_skkft->jabatan }}</p>
                            @else
                            <p class="pull-right">-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Bukti Fisik</b><a href="{{ url('/mahasiswa/skkft', $dataPengajuan->bukti_fisik) }}" target="_blank" class="pull-right">{{ $dataPengajuan->bukti_fisik }}</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="status_skkft" class="col-lg-2">Status SKKFT</label>
                    <div class="col-sm-6">
                        <select class="form-control select2" id="status_skkft" name="status_skkft">
                            <option value="">-- Pilih --</option>
                            <option value="1" @if($dataPengajuan->status == 1) selected @endif>Diterima</option>
                            <option value="2" @if($dataPengajuan->status == 2) selected @endif>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputError" class="col-lg-2">Keterangan</label>
                    <div class="col-sm-6">
                        <textarea name="keterangan" id="inputError" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Masukan Keterangan"></textarea>
                        @error('keterangan') <span class="help-block">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_skpi" class="col-lg-2">Status SKPI</label>
                    <div class="col-sm-6">
                        <input type="checkbox" name="status_skpi" value="1" @if($dataPengajuan->status_skpi == 1) checked @endif>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-info btn-flat mr-2">Simpan</button>
                <a href="{{ route('dashboardSkkft.index') }}" class="btn btn-light">Batal</a>
            </div>
            <div class="col-sm-10">

            </div>
        </div>
    </form>
</section>

@endsection

@push('scripts_page')
    <!-- Select2 -->
    <script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush