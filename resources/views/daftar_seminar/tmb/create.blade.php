@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

@include('layouts.alert')

@if(is_null($dataLog))

    <form action="{{ route('seminar_tmb.store') }}" method="post" enctype="multipart/form-data">@csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Informasi Kolokium Skripsi</h5>
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
                            <label for="dosen1_id">Pembimbing</label>
                            <select name="dosen1_id" id="dosen1_id" class="form-control select2">
                                <option value="">Pilih</option>
                                @foreach($dosen1 as $d)
                                <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dosen2_id">Co. Pembimbing</label>
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
            <div class="col-md-12">
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
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Upload File Persyaratan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_1" class="dropify" id="syarat_1">
                                <p class="col-form-label text-center" for="syarat_1">Bukti pembayaran Kolokium Skripsi</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_2" class="dropify" id="syarat_2">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_2">Sertifikat TOEFL</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_3" class="dropify" id="syarat_3">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_3">Formulir nilai bimbingan skripsi</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_4" class="dropify" id="syarat_4">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_4">Formulir kemajuan bimbingan skripsi</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_5" class="dropify" id="syarat_5">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_5">Formulir persetujuan kolokium skripsi</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_6" class="dropify" id="syarat_6">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_6">Formulir kesediaan menghadiri kolokium skripsi</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_7" class="dropify" id="syarat_7">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_7">Pas foto ukuran 4 x 6 sebanyak 2 lembar</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_8" class="dropify" id="syarat_8">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_8">Kartu Tanda Mahasiswa</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_9" class="dropify" id="syarat_9">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_9">Bukti pembayaran kuliah</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_10" class="dropify" id="syarat_10">
                                <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_10">Bukti perwalian</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_11" class="dropify" id="syarat_11">
                                <p class="col-form-label text-center" for="syarat_11">Bukti bebas pinjaman perpustakaan</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_12" class="dropify" id="syarat_12">
                                <p class="col-form-label text-center" for="syarat_12">Draft skripsi (PDF)</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_13" class="dropify" id="syarat_13">
                                <p class="col-form-label text-center" for="syarat_13">Draft skripsi (DOCX)</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="file" name="syarat_14" class="dropify" id="syarat_14">
                                <p class="col-form-label text-center" for="syarat_14">Transkrip Nilai <sub>(Dicap dan ditanda tangan Operator SIAA)</sub></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-info btn-flat">Ajukan</button>
                <a href="{{ route('dashboard.sidang') }}" class="btn btn-light btn-flat">Batal</a>
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