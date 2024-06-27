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
                    <form action="{{ route('poin-skkft.update', $point->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="category_id">Kategori SKKFT</label>
                            <div class="col-sm-6">
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c['id'] }}" @if(!empty($c['id']==$point['category_id'])) selected @endif>{{ $c['category_name'] }}</option>
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
                                    <option value="{{ $sc['id'] }}" @if(!empty($sc['id']==$point['subcategory_id'])) selected @endif>{{ $sc['subcategory_name'] }}</option>
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
                                    <option value="{{ $t['id'] }} @if(!empty($t['id']==$point['tingkat_id'])) selected @endif">{{ $t['tingkat'] }}</option>
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
                                    <option value="{{ $p['id'] }}" @if(!empty($p['id']==$point['prestasi_id'])) selected @endif>{{ $p['prestasi'] }}</option>
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
                                    <option value="{{ $j['id'] }} @if(!empty($j['id']==$point['jabatan_id'])) selected @endif">{{ $j['jabatan'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="point" class="col-lg-2 col-lg-offset-1 control-label">Poin</label>
                            <div class="col-lg-6">
                                <input type="number" name="point" id="point" class="form-control" value="{{ $point->point }}" required autofocus>
                                <span class="help-block with-errors"></span>
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
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>

@endpush