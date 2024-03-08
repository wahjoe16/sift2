@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Detail Arsip</h3>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Arsip</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-tag margin-r-5"></i> ID Arsip</strong>
                    <p class="text-muted">{{ $data->id }}</p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Nama Arsip</strong>
                    <p class="text-muted">{{ $data->name }}</p>
                    <hr>
                    <strong><i class="fa fa-folder margin-r-5"></i> Bidang</strong>
                    <p class="text-muted">{{ $data->section->name }}</p>
                    <hr>
                    <strong><i class="fa fa-cube margin-r-5"></i> Kategori</strong>
                    <p class="text-muted">{{ $data->category_archive->name }}</p>
                    <hr>
                    <strong><i class="fa fa-navicon margin-r-5"></i> Sub Kategori</strong>
                    @if ($data->subcategory_archive_id != '')
                    <p class="text-muted">{{ $data->subcategory_archive->name }}</p>
                    @else
                    <p>-</p>
                    @endif
                    <hr>
                    <strong><i class="fa fa-hourglass margin-r-5"></i> Tahun Akademik</strong>
                    <p class="text-muted">{{ $data->tahun_ajaran->tahun_ajaran }}</p>
                    <hr>
                    <strong><i class="fa fa-hourglass-end margin-r-5"></i> Semester</strong>
                    <p class="text-muted">{{ $data->semester->semester }}</p>
                    <hr>
                    <strong><i class="fa fa-hourglass-end margin-r-5"></i> Tanggal Upload</strong>
                    <p class="text-muted">{{ tanggal_indonesia($data->created_at) }}</p>
                    <hr>
                    <strong><i class="fa fa-user margin-r-5"></i> Dokumen atas Dosen</strong>
                    @foreach ($data->users as $item)
                    <p class="text-muted">{{ $item->nama }}</p><br>
                    @endforeach

                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Nama File : {{ $data->file }}</h4>
                </div>
                <div class="box-body">
                    <iframe src="{{ asset('file/archives/'.$data->file) }}" frameborder="0" width="700" height="500"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')

@endpush