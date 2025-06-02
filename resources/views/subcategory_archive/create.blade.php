@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Sub Kategori Arsip</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    {{ $title }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sub-category-archive.store') }}" method="post">@csrf
                    <div class="form-group">
                        <label for="section_id">Bidang Arsip</label>
                        <select name="section_id" id="section_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($section as $s)
                            <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_archive_id">Kategori Arsip</label>
                        <select name="category_archive_id" id="category_archive_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Sub Kategori Arsip</label>
                        <input type="text" name="name" id="name" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Sub Kategori Arsip</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('sub-category-archive.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')

<script>
    jQuery(document).ready(function() {
        jQuery('select[name="section_id"]').on('change', function() {
            var category = jQuery(this).val();
            if (category) {
                jQuery.ajax({
                    url: '/datamaster/dropdownlist/category-archive/' + category,
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
    })
</script>

@endpush