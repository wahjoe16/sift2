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
<form action="{{ route('my-archive.update', $data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Arsip</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="section_id">Bidang Arsip</label>
                        <select name="section_id" id="section_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($section as $s)
                            <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['section_id'])) selected @endif>{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_archive_id">Kategori Arsip</label>
                        <select name="category_archive_id" id="category_archive_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}" @if(!empty($c['id']==$data['category_archive_id'])) selected @endif>{{ $c['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_archive_id">Subkategori Arsip</label>
                        <select name="subcategory_archive_id" id="subcategory_archive_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($subcategory as $s)
                            <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['subcategory_archive_id'])) selected @endif>{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Akademik</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($ta as $t)
                            <option value="{{ $t['id'] }}" @if(!empty($t['id']==$data['tahun_ajaran_id'])) selected @endif>{{ $t['tahun_ajaran'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($smt as $s)
                            <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['semester_id'])) selected @endif>{{ $s['semester'] }}</option>
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
                    {{-- @if (!empty($data->file))
                    <div class="form-group">
                        <div class="col-md-12">
                            @php
                            $path = asset("/file/archives/$data->file");
                            @endphp
                            <a href="{{ asset('/file/archives/')."/".$data->file }}">
                                <p>{{ $data->file }}</p>
                            </a>
                        </div>
                    </div>
                    @endif --}}
                    <input type="file" name="file" class="dropify" data-default-file="{{ asset('storage/')."/".$data->file }}" multiple>
                    <input type="hidden" name="oldfile" value="{{ $data->file }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('my-archive.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
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

@endpush