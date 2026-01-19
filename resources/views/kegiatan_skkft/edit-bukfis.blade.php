@extends('layouts.dashboard')

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">{{ $title }}</h3>
    </div>
</div>

<form action="{{ route('kegiatan-bukfis.upload', $kegiatan->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Kegiatan</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="form-control" disabled required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group pb-5">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="text" name="tanggal" id="tanggal" value="{{  Carbon\Carbon::parse($kegiatan->tanggal)->format('m-d-Y') }}" class="form-control" disabled required autofocus>
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
                        <select name="category_id" id="category_id" class="form-control" disabled>
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}" @if(!empty($c['id']==$kegiatan['category_id'])) selected @endif>{{ $c['category_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_id">Sub Kategori</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control" disabled>
                            <option value="">Pilih</option>
                            @foreach($subcategory as $sc)
                            <option value="{{ $sc['id'] }}" @if(!empty($sc['id']==$kegiatan['subcategory_id'])) selected @endif>{{ $sc['subcategory_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tingkat_id">Tingkat</label>
                        <select name="tingkat_id" id="tingkat_id" class="form-control" disabled>
                            <option value="">Pilih</option>
                            @foreach($tingkat as $t)
                            <option value="{{ $t['id'] }}" @if(!empty($t['id']==$kegiatan['tingkat_id'])) selected @endif>{{ $t['tingkat'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prestasi_id">Prestasi</label>
                        <select name="prestasi_id" id="prestasi_id" class="form-control" disabled>
                            <option value="">Pilih</option>
                            @foreach($prestasi as $p)
                            <option value="{{ $p['id'] }}" @if(!empty($p['id']==$kegiatan['prestasi_id'])) selected @endif>{{ $p['prestasi'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control" disabled>
                            <option value="">Pilih</option>
                            @foreach($jabatan as $j)
                            <option value="{{ $j['id'] }}" @if(!empty($j['id']==$kegiatan['jabatan_id'])) selected @endif>{{ $j['jabatan'] }}</option>
                            @endforeach
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
                    <input type="file" name="bukti_fisik" class="dropify" id="bukti_fisik" data-default-file="{{ asset('storage/')."/".$kegiatan->bukti_fisik }}">
                    <input type="hidden" name="current_bukti_fisik" id="current_bukti_fisik" value="{{ $kegiatan->bukti_fisik }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="btn-groups">
            <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('kegiatan.index') }}" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>

@endsection

@push('scripts_page')

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

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

@endpush