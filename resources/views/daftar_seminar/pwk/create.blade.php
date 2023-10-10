@extends('layouts.master')

@push('css_page')

@endpush
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">
@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <form class="form-horizontal" action="{{ route('seminar_pwk.store') }}" method="post" enctype="multipart/form-data">@csrf
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Sidang Pembahasan</h3>
                    </div>

                    <div class="row">
                        <div class="box-body">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-5 col-form-label" for="tahun_ajaran_id">Tahun Akademik</label>
                                    <div class="col-sm-7">
                                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2">
                                            <option value="">Pilih</option>
                                            @foreach($tahun_ajaran as $ta)
                                            <option value="{{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 col-form-label" for="semester_id">Semester</label>
                                    <div class="col-sm-7">
                                        <select name="semester_id" id="semester_id" class="form-control select2">
                                            <option value="">Pilih</option>
                                            @foreach($semester as $s)
                                            <option value="{{ $s['id'] }}">{{ $s['semester'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 col-form-label" for="dosen1_id">Dosen Pembimbing 1</label>
                                    <div class="col-sm-7">
                                        <select name="dosen1_id" id="dosen1_id" class="form-control select2">
                                            <option value="">Pilih</option>
                                            @foreach($dosen1 as $d)
                                            <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 col-form-label" for="dosen2_id">Dosen Pembimbing 2</label>
                                    <div class="col-sm-7">
                                        <select name="dosen2_id" id="dosen2_id" class="form-control select2">
                                            <option value="">Pilih</option>
                                            @foreach($dosen2 as $d)
                                            <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-sm-9">
                                        <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Informasi Penting!</h4>
                    Sebelum melakukan upload file persyaratan, mahasiswa diharuskan memperhatikan informasi berikut.
                    <ol>
                        <li>Semua file harus mempunyai format PDF kecuali jika ada draft skripsi yang diharuskan mempunyai format DOC/DOCX.</li>
                        <li>Semua file yang diupload maksimal berukuran 1MB kecuali file draft skripsi(jika ada).</li>
                        <li>Jika diharuskan upload file transkrip nilai, file tersebut harus sudah diketahui sekretariat program studi.</li>
                    </ol>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload persyaratan</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="box-body">
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_1" class="dropify" id="syarat_1">
                                    <p class="col-form-label text-center" for="syarat_1">Lembar bimbingan skripsi (minimal 10x bimbingan)</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_2" class="dropify" id="syarat_2">
                                    <p class="col-form-label text-center" for="syarat_2">Sertifikat pesantren mahasiswa baru</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_3" class="dropify" id="syarat_3">
                                    <p class="col-form-label text-center" for="syarat_3">Sertifikat pesantren calon sarjana<sub class="text-red"> (Jika sudah ada)</sub></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_4" class="dropify" id="syarat_4">
                                    <p class="col-form-label text-center" for="syarat_4">Transkrip nilai <sub class="text-red">(Dicap dan ditanda tangan Operator SIAA)</sub></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_5" class="dropify" id="syarat_5">
                                    <p class="col-form-label text-center" for="syarat_5">Sertifikat TOEFL (Skor Minimal 475)<sub class="text-red"> (Jika sudah ada)</sub></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_6" class="dropify" id="syarat_6">
                                    <p class="col-form-label text-center" for="syarat_6">Bukti bebas pinjaman perpustakaan</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_7" class="dropify" id="syarat_7">
                                    <p class="col-form-label text-center" for="syarat_7">Sertifikat SKKFT<sub class="text-red"> (Jika sudah ada)</sub></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="file" name="syarat_8" class="dropify" id="syarat_8">
                                    <p class="col-form-label text-center" for="syarat_8">Bukti KRS (pengambilan MK. Skripsi)</p>
                                </div>
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

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info btn-flat">Ajukan</button>
                        <a href="{{ route('dashboard.sidang') }}" class="btn btn-link">Batal</a>

                    </div>
                    <!-- /.box-footer -->
                </div>
            </form>
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

        $('.dropify').dropify();
        $('#datepicker-popup').datepicker();
    })
</script>

@endpush