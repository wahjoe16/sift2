@extends('layouts.dashboard')

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Tambah Data Kegiatan SKKFT</h3>
    </div>
</div>
@include('layouts.alert')
<form action="{{ route('kegiatan.store') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Kegiatan</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan&nbsp;<sub>(Minimal 30 karakter)</sub></label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group pb-5">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="text" name="tanggal" id="tanggal" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Kategori Kegiatan</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}">{{ $c['category_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_id">Sub Kategori</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tingkat_id">Tingkat</label>
                        <select name="tingkat_id" id="tingkat_id" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prestasi_id">Prestasi</label>
                        <select name="prestasi_id" id="prestasi_id" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Upload File Bukti Fisik</h5>
                </div>
                <div class="card-body">
                    <input type="file" name="bukti_fisik" class="dropify" id="bukti_fisik">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="btn-groups">
            <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('poin-skkft.index') }}" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>    

@endsection

@push('scripts_page')

<!-- bootstrap datepicker -->
<script src="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
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