@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Detail Arsip Fakultas Teknik</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Informasi Arsip</h5>
            </div>
            <div class="card-body">
                <h3 class="card-title"> ID Arsip</h3>
                <p class="card-text">{{ $data->id }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Nama Arsip</h3>
                <p class="card-text">{{ $data->name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Bidang</h3>
                <p class="card-text">{{ $data->section->name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Kategori</h3>
                <p class="card-text">{{ $data->category_archive->name }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Sub Kategori</h3>
                <p class="card-text">
                    @if ($data->subcategory_archive_id != '')
                    {{ $data->subcategory_archive->name }}
                    @else
                    -
                    @endif
                </p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tahun Akademik</h3>
                <p class="card-text">{{ $data->tahun_ajaran->tahun_ajaran }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Semester</h3>
                <p class="card-text">{{ $data->semester->semester }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Tanggal Upload</h3>
                <p class="card-text">{{ tanggal_indonesia($data->created_at) }}</p>

                <div class="separator-solid"></div>
                <h3 class="card-title">Dokumen atas Dosen</h3>
                <p class="card-text">
                    @foreach ($data->users as $item)
                    <ul>
                        <li>{{ $item->nama }}</li>
                    </ul>
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>File Arsip : {{ $data->file }}</h5>
            </div>
            <div class="card-body">
                <iframe src="{{ asset('storage/'.$data->file) }}" frameborder="0" width="700" height="500"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection