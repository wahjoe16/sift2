@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

@include('layouts.alert')

@if (is_null($dataLog))

<form class="form-horizontal" action="{{ route('seminar_pwk.store') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Sidang Pembahasan</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Akademik</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($tahun_ajaran as $ta)
                            <option value="{{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($semester as $s)
                            <option value="{{ $s['id'] }}">{{ $s['semester'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosen1_id">Dosen Pembimbing 1</label>
                        <select name="dosen1_id" id="dosen1_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($dosen1 as $d)
                            <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosen2_id">Dosen Pembimbing 2</label>
                        <select name="dosen2_id" id="dosen2_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($dosen2 as $d)
                            <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Judul Skripsi</h5>
                </div>
                <div class="card-body">
                    <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="13"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="alert alert-warning alert-dismissible">
            <h4><i class="icon fa fa-warning"></i> Informasi Penting!</h4>
            Sebelum melakukan upload file persyaratan, mahasiswa diharuskan memperhatikan informasi berikut.
            <ol>
                <li>Semua file harus mempunyai format PDF kecuali jika ada draft skripsi yang diharuskan mempunyai format DOC/DOCX.</li>
                <li>Semua file yang diupload maksimal berukuran 1MB kecuali file draft skripsi(jika ada).</li>
                <li>Jika diharuskan upload file transkrip nilai, file tersebut harus sudah diketahui sekretariat program studi.</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5>Dokumen Persyaratan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_1" class="dropify" id="syarat_1">
                        <p class="col-form-label text-center" for="syarat_1">Lembar bimbingan skripsi (minimal 10x bimbingan)</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_2" class="dropify" id="syarat_2">
                        <p class="col-form-label text-center" for="syarat_2">Sertifikat pesantren mahasiswa baru</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_3" class="dropify" id="syarat_3">
                        <p class="col-form-label text-center" for="syarat_3">Sertifikat pesantren calon sarjana<sub class="text-red"> (Jika sudah ada)</sub></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_4" class="dropify" id="syarat_4">
                        <p class="col-form-label text-center" for="syarat_4">Transkrip nilai <sub class="text-red">(Dicap dan ditanda tangan Operator SIAA)</sub></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_5" class="dropify" id="syarat_5">
                        <p class="col-form-label text-center" for="syarat_5">Sertifikat TOEFL (Skor Minimal 475)<sub class="text-red"> (Jika sudah ada)</sub></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_6" class="dropify" id="syarat_6">
                        <p class="col-form-label text-center" for="syarat_6">Bukti bebas pinjaman perpustakaan</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_7" class="dropify" id="syarat_7">
                        <p class="col-form-label text-center" for="syarat_7">Sertifikat SKKFT<sub class="text-red"> (Jika sudah ada)</sub></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_8" class="dropify" id="syarat_8">
                        <p class="col-form-label text-center" for="syarat_8">Bukti KRS (pengambilan MK. Skripsi)</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_9" class="dropify" id="syarat_9">
                        <p class="col-form-label text-center" for="syarat_9">Bukti pembayaran DPP Mk. Skripsi</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <input type="file" name="syarat_10" class="dropify" id="syarat_10">
                        <p class="col-form-label text-center" for="syarat_10">Bukti pembayaran sidang pembahasan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-info btn-flat">Ajukan</button>
            <a href="{{ route('dashboard.sidang') }}" class="btn btn-link">Batal</a>
        </div>
    </div>
</form>

@else

    <div class="error-page">
        <h2 class="headline text-red">500</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Halaman di Block.</h3>

            <p>
                Mungkin anda sudah melakukan upload dokumen.
                Tunggu informasi selanjutnya, Silahkan <a href="{{ route('dashboard.sidang') }}">kembali ke halaman dashboard</a>.
            </p>

        </div>
    </div>

@endif

@endsection

@push('scripts_page')
<!-- Select2 -->
<script src="{{ asset('kai/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>


<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        $('.dropify').dropify();
        $('#datepicker-popup').datepicker();
    })
</script>

@endpush