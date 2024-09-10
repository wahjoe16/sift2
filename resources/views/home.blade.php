@extends('layouts.dashboard')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                {{-- Menu untuk semua user yang aktif  --}}
                @if (auth()->user()->status_aktif == 1)
                    @include('home_menu.user_aktif')
                @endif

                {{-- Menu untuk Dosen yang aktif  --}}
                @if (auth()->user()->level == 2 && auth()->user()->status_aktif == 1)
                    @include('home_menu.dosen')
                @endif

                {{-- Menu untuk admin yang aktif --}}
                @if (auth()->user()->level == 1 && auth()->user()->status_aktif == 1)
                    @include('home_menu.admin')
                @endif

                {{-- Menu untuk mahasiswa yang aktif --}}
                @if (auth()->user()->level == 3 && auth()->user()->status_aktif == 1)
                    @include('home_menu.mahasiswa')
                @endif

                {{-- Menu untuk dosen dekanat --}}
                @if (auth()->user()->level == 2 && auth()->user()->status_aktif == 1 && auth()->user()->status_dekanat == 1)
                    @include('home_menu.dekanat')
                @endif
            
                {{-- Menu untuk alumni --}}
                @if (auth()->user()->status_aktif == 0)
                    @include('home_menu.alumni')
                @endif
                
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
                    <li>Bagi Mahasiswa wanita, unggah foto menggunakan latar belakang biru, dan memakai pakaian resmi serta memakai hijab.</li>
                </ol>
            </div>
        </div>
    </div>
</section>

@endsection