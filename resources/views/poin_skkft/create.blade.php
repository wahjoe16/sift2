@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Poin SKKFT</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('poin-skkft.store') }}" method="post">@csrf
                    <div class="form-group">
                        <label for="category_id">Kategori SKKFT</label>
                        <select name="category_id" id="category_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}">{{ $c['category_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_id">Sub Kategori SKKFT</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($subcategory as $sc)
                            <option value="{{ $sc['id'] }}">{{ $sc['subcategory_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tingkat_id">Tingkat</label>
                        <select name="tingkat_id" id="tingkat_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($tingkat as $t)
                            <option value="{{ $t['id'] }}">{{ $t['tingkat'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prestasi_id">Prestasi</label>
                        <select name="prestasi_id" id="prestasi_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($prestasi as $p)
                            <option value="{{ $p['id'] }}">{{ $p['prestasi'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($jabatan as $j)
                            <option value="{{ $j['id'] }}">{{ $j['jabatan'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="point">Poin</label>
                        <input type="number" name="point" id="point" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
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

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('kai/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>

<script>
    jQuery(document).ready(function() {
        
        jQuery('select[name="category_id"]').on('change', function() {
            var subcategory = jQuery(this).val();
            if (subcategory) {
                jQuery.ajax({
                    url: '/datamaster/dropdownlist/subcategory-skkft/' + subcategory,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="subcategory_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="subcategory_id"]').empty();
            }
        })

    })
</script>

@endpush