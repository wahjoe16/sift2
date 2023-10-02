@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        {{ $title }}
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('my-archive.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="name">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="section_id">Bidang Arsip</label>
                            <div class="col-sm-6">
                                <select name="section_id" id="section_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($section as $s)
                                    <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['section_id'])) selected @endif>{{ $s['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="category_archive_id">Kategori Arsip</label>
                            <div class="col-sm-6">
                                <select name="category_archive_id" id="category_archive_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c['id'] }}" @if(!empty($c['id']==$data['category_archive_id'])) selected @endif>{{ $c['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="subcategory_archive_id">Subkategori Arsip</label>
                            <div class="col-sm-6">
                                <select name="subcategory_archive_id" id="subcategory_archive_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($subcategory as $s)
                                    <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['subcategory_archive_id'])) selected @endif>{{ $s['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="tahun_ajaran_id">Tahun Akademik</label>
                            <div class="col-sm-6">
                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($ta as $t)
                                    <option value="{{ $t['id'] }}" @if(!empty($t['id']==$data['tahun_ajaran_id'])) selected @endif>{{ $t['tahun_ajaran'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="semester_id">Semester</label>
                            <div class="col-sm-6">
                                <select name="semester_id" id="semester_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($smt as $s)
                                    <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['semester_id'])) selected @endif>{{ $s['semester'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (!empty($data->file))
                        <div class="form-group row">
                            <div class="col-lg-2 col-lg-offset-1"></div>
                            <div class="col-md-6">
                                @php
                                $path = asset("/file/archives/$data->file");
                                @endphp
                                <a href="{{ asset('/file/archives/')."/".$data->file }}">
                                    <p>{{ $data->file }}</p>
                                </a>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="description">Upload File Arsip</label>
                            <div class="col-sm-6">
                                <input type="file" name="file" class="dropify" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('my-archive.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
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
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        // dropify
        $('.dropify').dropify();
    })
</script>

@endpush