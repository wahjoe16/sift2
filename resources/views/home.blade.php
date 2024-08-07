@extends('layouts.dashboard')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                @if (auth()->user()->status_aktif == 1)
                    <div class="col-md-6 col-sm-6 col-xs-12">
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
                @endif
                @if (auth()->user()->level == 2 && auth()->user()->status_aktif == 1)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Arsip</h3>

                            <p>Fakultas Teknik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="{{ route('my-archive.index') }}" class="small-box-footer">
                            Klik Disini <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @elseif (auth()->user()->level == 1 && auth()->user()->status_aktif == 1)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Arsip</h3>

                            <p>Fakultas Teknik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="{{ route('ft-arsip.index') }}" class="small-box-footer">
                            Klik Disini <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endif
                @if (auth()->user()->status_aktif == 1)
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>SKKFT</h3>

                                <p>Satuan Kegiatan Kemahasiswaan Fakultas Teknik</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            @if (auth()->user()->level == 3)
                                <a href="{{ route('kegiatan.index') }}" class="small-box-footer">
                                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            @endif
                            @if (auth()->user()->level == 1)
                                <a href="{{ route('dashboardSkkft.index') }}" class="small-box-footer">
                                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            @endif
                            @if (auth()->user()->level == 2)
                                <a href="{{ route('sertifikat.index') }}" class="small-box-footer">
                                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
                @if (auth()->user()->status_aktif == 1)
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>SKPI</h3>

                                <p>Surat Keterangan Pendamping Ijazah</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            @if (auth()->user()->level == 1)
                                <a href="{{ route('skpi.list') }}" class="small-box-footer">
                                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            @endif
                            @if (auth()->user()->level == 2)
                                <a href="{{ route('skpi.index') }}" class="small-box-footer">
                                    Klik Disini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3>Alumni</h3>

                            <p>Database Alumni Fakultas Teknik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-male"></i>
                        </div>
                        <?php
                            $data = auth()->user();
                        ?>
                        @if (auth()->user()->status_aktif == 0)
                            <a href="{{ route('alumni.show-edit') }}" class="small-box-footer">
                                Klik Disini <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        @else
                            <a href="{{ route('alumni.index') }}" class="small-box-footer">
                                Klik Disini <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Informasi Penting!</h4>
                <strong>Sebelum menggunakan Sistem Informasi ini, pengguna diharuskan memperhatikan informasi berikut.</strong>
                <hr>
                <ol>
                    <li>Untuk kepentingan keamanan data, bagi Mahasiswa, Dosen, Ataupun Admin yang sudah bisa Login di Sistem Informasi ini diwajibkan untuk segera mengganti Password.</li>
                    <li>Bagi Mahasiswa dan Dosen, lengkapi profil anda agar menu di sidebar ditampilkan seluruhnya.</li>
                    <li>Bagi Mahasiswa pria, unggah foto menggunakan latar belakang biru, dan memakai pakaian resmi.</li>
                    <li>Bagi Mahasiswa wanita, unggah foto menggunakan latar belakang biru, dan memakai pakaian resmi dan memakai hijab.</li>
                </ol>
            </div>
        </div>
    </div>
</section>

@endsection