@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Detail Arsip</h3>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Informasi Arsip</h4>
                </div>
                <div class="box-body">
                    <ul class="nav nav-stacked">
                        <li><a href="#"><b>Nama Arsip</b><span class="pull-right">{{ $data->name }}</span></a></li>
                        <li><a href="#"><b>Bidang</b><span class="pull-right">{{ $data->section->name }}</span></a></li>
                        <li><a href="#"><b>Kategori </b><span class="pull-right">{{ $data->category_archive->name }}</span></a></li>
                        <li><a href="#"><b>Sub Kategori</b><span class="pull-right">{{ $data->subcategory_archive->name }}</span></a></li>
                        <li><a href="#"><b>Tahun Akademik</b><span class="pull-right">{{ $data->tahun_ajaran->tahun_ajaran }}</span></a></li>
                        <li><a href="#"><b>Semester</b><span class="pull-right">{{ $data->semester->semester }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Nama File : {{ $data->file }}</h4>
                </div>
                <div class="box-body">
                    <iframe src="{{ asset('file/archives/'.$data->file) }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')

@endpush