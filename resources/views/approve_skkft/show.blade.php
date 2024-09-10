@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<section class="content-header">
    <h3>Detil Kegiatan SKKFT</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
        <div class="row">
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Mahasiswa</h3>
                    </div>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . $data->user_skkft->foto) }}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{ $data->user_skkft->nama }}</h3>
                        <p class="text-muted text-center">{{ $data->user_skkft->nik }}</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <p>Program Studi</p>
                                <b>{{ $data->user_skkft->program_studi }}</b>
                            </li>
                            <li class="list-group-item">
                                <p>Email</p>
                                <b>{{ $data->user_skkft->email }}</b>
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
                            <b>Nama Kegiatan</b> 
                            <p>{{ $data->nama_kegiatan }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Kegiatan</b> <p>{{ tanggal_indonesia($data->tanggal) }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Pengajuan</b> <p>{{ tanggal_indonesia($data->created_at) }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Kategori</b> <p>{{ $data->categories_skkft->category_name }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Sub Kategori</b> <p>{{ $data->subcategories_skkft->subcategory_name }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Tingkat</b> 
                            @if ($data->tingkat_id != '')
                                <p>{{ $data->tingkat_skkft->tingkat }}</p>
                            @else
                            <p>-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Prestasi</b> 
                            @if ($data->prestasi_id != '')
                                <p>{{ $data->prestasi_skkft->prestasi }}</p>
                            @else
                            <p>-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Jabatan</b> 
                            @if ($data->jabatan_id != '')
                                <p>{{ $data->jabatan_skkft->jabatan }}</p>
                            @else
                            <p>-</p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Bukti Fisik</b><p><a href="{{ url('/mahasiswa/skkft', $data->bukti_fisik) }}">{{ $data->bukti_fisik }}</a></p>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        
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