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
                    <form action="{{ route('kegiatan.store') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="nama_kegiatan" class="col-lg-2 col-lg-offset-1 control-label">Nama Kegiatan</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-lg-2 col-lg-offset-1 control-label">Tanggal Kegiatan</label>
                            <div class="col-lg-6">
                                <input type="text" name="tanggal" id="tanggal" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="category_id">Kategori SKKFT</label>
                            <div class="col-sm-6">
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['category_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="subcategory_id">Sub Kategori SKKFT</label>
                            <div class="col-sm-6">
                                <select name="subcategory_id" id="subcategory_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    {{-- @foreach ($subcategory as $s)
                                        <option value="{{ $s->id }}">{{ $s->subcategory_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="tingkat_id">Tingkat</label>
                            <div class="col-sm-6">
                                <select name="tingkat_id" id="tingkat_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    {{-- @foreach ($tingkat as $t)
                                        <option value="{{ $t->id }}">{{ $t->tingkat }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="prestasi_id">Prestasi</label>
                            <div class="col-sm-6">
                                <select name="prestasi_id" id="prestasi_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    {{-- @foreach ($prestasi as $p)
                                        <option value="{{ $p->id }}">{{ $p->prestasi }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="jabatan_id">Jabatan</label>
                            <div class="col-sm-6">
                                <select name="jabatan_id" id="jabatan_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="bukti_fisik">Upload Bukti Fisik</label>
                            <div class="col-sm-6">
                                <input type="file" name="bukti_fisik" class="dropify" id="bukti_fisik">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('poin-skkft.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
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
<script>
    jQuery(document).ready(function() {
        
        jQuery('select[name="category_id"]').on('change', function() {
            var subcategory = jQuery(this).val();
            if (subcategory) {
                jQuery.ajax({
                    url: '/skkft/dropdownlist/subcategory-skkft/' + subcategory,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="subcategory_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option>Pilih</option><option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="subcategory_id"]').empty();
            }
        })

        jQuery('select[name="subcategory_id"]').on('change', function() {
            var tingkat = jQuery(this).val();
            if (tingkat) {
                jQuery.ajax({
                    url: '/skkft/dropdownlist/tingkat-skkft/' + tingkat,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="tingkat_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="tingkat_id"]').append('<option>Pilih</option><option value="' + value.tingkat_skkft.id + '">' + value.tingkat_skkft.tingkat + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="tingkat_id"]').empty();
            }
        })

        jQuery('select[name="subcategory_id"]').on('change', function() {
            var prestasi = jQuery(this).val();
            if (prestasi) {
                jQuery.ajax({
                    url: '/skkft/dropdownlist/prestasi-skkft/' + prestasi,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="prestasi_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="prestasi_id"]').append('<option>Pilih</option><option value="' + value.prestasi_skkft.id + '">' + value.prestasi_skkft.prestasi + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="prestasi_id"]').empty();
            }
        })

        jQuery('select[name="subcategory_id"]').on('change', function() {
            var jabatan = jQuery(this).val();
            if (jabatan) {
                jQuery.ajax({
                    url: '/skkft/dropdownlist/jabatan-skkft/' + jabatan,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="jabatan_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="jabatan_id"]').append('<option>Pilih</option><option value="' + value.jabatan_skkft.id + '">' + value.jabatan_skkft.jabatan + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="jabatan_id"]').empty();
            }
        })

    })
</script>

@endpush