@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Tambah Arsip Saya</h3>
    </div>
</div>
@include('layouts.alert')
<form action="{{ route('my-archive.store') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Arsip</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="section_id">Nama Arsip</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="section_id">Sesi Arsip</label>
                        <select name="section_id" id="section_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($section as $s)
                            <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_archive_id">Kategori Arsip</label>
                        <select name="category_archive_id" id="category_archive_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_archive_id">Subkategori Arsip</label>
                        <select name="subcategory_archive_id" id="subcategory_archive_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($subcategory as $s)
                            <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Akademik</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($ta as $t)
                            <option value="{{ $t['id'] }}">{{ $t['tahun_ajaran'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($smt as $s)
                            <option value="{{ $s['id'] }}">{{ $s['semester'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>File Arsip</h5>
                </div>
                <div class="card-body">
                    <input type="file" name="file[]" class="dropify" multiple required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('my-archive.index') }}" class="btn btn-sm btn-light"><i class="fas fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('kai/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        // dropify
        $('.dropify').dropify();
    })
</script>

<!-- Dependent Dropdown -->
<script>
    jQuery(document).ready(function() {
        jQuery('select[name="section_id"]').on('change', function() {
            var category = jQuery(this).val();
            if (category) {
                jQuery.ajax({
                    url: '/archives/dropdownlist/category-archive/' + category,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="category_archive_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="category_archive_id"]').append('<option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="category_archive_id"]').empty();
            }
        })

        jQuery('select[name="category_archive_id"]').on('change', function() {
            var subcategory = jQuery(this).val();
            if (subcategory) {
                jQuery.ajax({
                    url: '/archives/dropdownlist/sub-category-archive/' + subcategory,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="subcategory_archive_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="subcategory_archive_id"]').append('<option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="subcategory_archive_id"]').empty();
            }
        })
    })
</script>
<!-- end Dependent Dropdown -->

@endpush