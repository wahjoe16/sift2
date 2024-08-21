@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="{{ route('skpi.update', $data->id) }}" method="post">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="text-muted">
                            Cetak Data SKPI
                        </h3>
                    </div>
                    <div class="box-body">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama">Nama Mahasiswa</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="{{ $data->user_skpi->nama }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="program_studi">Program Studi</label>
                                    <input type="text" name="program_studi" class="form-control" id="program_studi" value="{{ $data->user_skpi->program_studi }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" value="{{ $data->tempat_lahir }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_skpi">Nomor SKPI</label>
                                    <input type="text" name="no_skpi" class="form-control" id="no_skpi" placeholder="Nomor SKPI" value="{{ $data->no_skpi }}">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk Perkuliahan</label>
                                    <input type="text" name="tanggal_masuk" class="form-control" id="tanggal" placeholder="Tanggal Masuk Perkuliahan" value="{{ $data->tanggal_masuk }}">
                                </div>
                                <div class="form-group">
                                    <label for="akre_fakultas">Akreditasi Fakultas</label>
                                    <select name="akre_fakultas" id="akre_fakultas" class="form-control select2 text-black">
                                        <option value="">Select</option>
                                            @foreach ([
                                                "Unggul"=>"Unggul",
                                                "Baik Sekali"=>"Baik Sekali",
                                                "Baik"=>"Baik",
                                                "Tak Terakreditasi"=>"Tak Terakreditasi"
                                                ] as $akre_fakultas => $akre_fakultasLabel)
                                                <option value="{{ $akre_fakultas }}" {{ old('akre_fakultas', $data->akreditasi_fakultas)==$akre_fakultas ? "selected" : "" }}>{{ $akre_fakultasLabel }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="akre_prodi">Akreditasi Program Studi</label>
                                    <select name="akre_prodi" id="akre_prodi" class="form-control select2 text-black">
                                        <option value="">Select</option>
                                            @foreach ([
                                                "Unggul"=>"Unggul",
                                                "Baik Sekali"=>"Baik Sekali",
                                                "Baik"=>"Baik",
                                                "Tak Terakreditasi"=>"Tak Terakreditasi"
                                                ] as $akre_prodi => $akre_prodiLabel)
                                                <option value="{{ $akre_prodi }}" {{ old('akre_prodi', $data->akreditasi_prodi)==$akre_prodi ? "selected" : "" }}>{{ $akre_prodiLabel }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nik">NPM</label>
                                    <input type="text" name="nik" class="form-control" id="nik" value="{{ $data->user_skpi->nik }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="fakultas">Fakultas</label>
                                    <input type="text" name="fakultas" class="form-control" id="fakultas" value="Fakultas Teknik" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" name="tanggal_lahir" class="form-control" id="tanggal2" placeholder="Tanggal Lahir" @if($data->tanggal_lahir != '') value="{{ $data->tanggal_lahir }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="no_ijazah">Nomor Ijazah</label>
                                    <input type="text" name="no_ijazah" class="form-control" id="no_ijazah" placeholder="Nomor Ijazah" value="{{ $data->no_ijazah }}">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lulus">Tanggal Lulus Perkuliahan</label>
                                    <input type="text" name="tanggal_lulus" class="form-control" id="tanggal3" placeholder="Tanggal Lulus Perkuliahan" value="{{ $data->tanggal_lulus }}">
                                </div>
                                <div class="form-group">
                                    <label for="lama_studi">Lama Studi</label>
                                    <input type="text" name="lama_studi" class="form-control" id="lama_studi" placeholder="Lama Studi" value="{{ $data->lama_studi }}">
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="box-footer with-border">
                        <button class="btn btn-sm btn-flat btn-info"><i class="fa fa-save"></i> Simpan</button>
                        <a href="{{ route('skpi.print', $data->id) }}" class="btn btn-sm btn-flat btn-success" @if($data->status_cetak == 0) disabled @endif><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Date picker -->
<!-- bootstrap datepicker -->
<script src="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Date picker
        $('#tanggal').datepicker({
            autoclose: true
        })

        //Date picker
        $('#tanggal2').datepicker({
            autoclose: true
        })

        //Date picker
        $('#tanggal3').datepicker({
            autoclose: true
        })
    })
</script>

@endpush