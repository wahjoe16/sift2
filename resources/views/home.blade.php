@extends('layouts.dashboard')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Sidang</h3>

                    <p>Dokumentasi Persyaratan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <a href="{{ route('dashboard.sidang') }}" class="small-box-footer">
                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @if (auth()->user()->level == 1 || auth()->user()->level == 2)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Arsip</h3>

                    <p>Fakultas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endif
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Mahasiswa</h3>

                    <p>Satuan Kegiatan Kemahasiswaan Fakultas Teknik</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="https://skkft.unisba.ac.id/" class="small-box-footer">
                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @if (auth()->user()->level == 1)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Data Master</h3>

                    <p>Fakultas Teknik</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <a href="{{ route('dashboard.datamaster') }}" class="small-box-footer">
                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection