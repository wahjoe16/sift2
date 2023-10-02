@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

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
                    <form action="{{ route('sub-category-archive.update', $data->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="section_id">Sesi Arsip</label>
                            <div class="col-sm-6">
                                <select name="section_id" id="section_id" class="form-control select2">
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
                                <select name="category_archive_id" id="category_archive_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c['id'] }}" @if(!empty($c['id']==$data['category_archive_id'])) selected @endif>{{ $c['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-lg-offset-1 control-label">Sub Kategori Arsip</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="description">Deskripsi Kategori Arsip</label>
                            <div class="col-sm-6">
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
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
</section>

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>

@endpush