@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        {{ $title }}
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nama_kegiatan" class="col-lg-2 col-lg-offset-1 control-label">Nama Kegiatan</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-lg-2 col-lg-offset-1 control-label">Tanggal Kegiatan</label>
                            <div class="col-lg-6">
                                <input type="text" name="tanggal" id="tanggal" value="{{ $kegiatan->tanggal }}" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="category_id">Kategori SKKFT</label>
                            <div class="col-sm-6">
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c['id'] }}" @if(!empty($c['id']==$kegiatan['category_id'])) selected @endif>{{ $c['category_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="subcategory_id">Sub Kategori SKKFT</label>
                            <div class="col-sm-6">
                                <select name="subcategory_id" id="subcategory_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($subcategory as $sc)
                                    <option value="{{ $sc['id'] }}" @if(!empty($sc['id']==$kegiatan['subcategory_id'])) selected @endif>{{ $sc['subcategory_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="tingkat_id">Tingkat</label>
                            <div class="col-sm-6">
                                <select name="tingkat_id" id="tingkat_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($tingkat as $t)
                                    <option value="{{ $t['id'] }}" @if(!empty($t['id']==$kegiatan['tingkat_id'])) selected @endif>{{ $t['tingkat'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="prestasi_id">Prestasi</label>
                            <div class="col-sm-6">
                                <select name="prestasi_id" id="prestasi_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($prestasi as $p)
                                    <option value="{{ $p['id'] }}" @if(!empty($p['id']==$kegiatan['prestasi_id'])) selected @endif>{{ $p['prestasi'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="jabatan_id">Jabatan</label>
                            <div class="col-sm-6">
                                <select name="jabatan_id" id="jabatan_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($jabatan as $j)
                                    <option value="{{ $j['id'] }}" @if(!empty($j['id']==$kegiatan['jabatan_id'])) selected @endif>{{ $j['jabatan'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="bukti_fisik">Upload Bukti Fisik</label>
                            <div class="col-sm-6">
                                <input type="file" name="bukti_fisik" class="dropify" id="bukti_fisik">
                                @if (!empty($kegiatan->bukti_fisik))
                                    <a href="{{ asset('/mahasiswa/skkft/')."/".$kegiatan->bukti_fisik }}" target="_blank">
                                        <p>{{ $kegiatan->bukti_fisik }}</p>
                                    </a>
                                    <input type="hidden" name="current_bukti_fisik" id="current_bukti_fisik" value="{{ $kegiatan->bukti_fisik }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        // dropify
        $('.dropify').dropify();

        //Date picker
        $('#tanggal').datepicker({
            autoclose: true
        })
    })
</script>

@endpush