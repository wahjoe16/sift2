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
            <form class="form-horizontal" action="{{ route('sidang_ti.update', $data->id) }}" method="post" enctype="multipart/form-data">@csrf
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Sidang Tugas Akhir</h3>
                    </div>

                    <div class="row">
                        <div class="box-body">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-5 col-form-label" for="tahun_ajaran_id">Tahun Akademik</label>
                                    <div class="col-sm-7">
                                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2">
                                            <option value="">Pilih</option>
                                            <option value="{{ $data['tahun_ajaran_id'] }}" selected>{{ $data['tahun_ajaran']['tahun_ajaran'] }}</option>
                                            @foreach($tahun_ajaran as $ta)
                                            <option value=" {{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 col-form-label" for="semester_id">Semester</label>
                                    <div class="col-sm-7">
                                        <select name="semester_id" id="semester_id" class="form-control select2">
                                            <option value="">Pilih</option>
                                            <option value="{{ $data['semester_id'] }}" selected>{{ $data['semester']['semester'] }}</option>
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
                                            <option value="{{ $d['id'] }}" @if(!empty($d['id']==$data['dosen1_id'])) selected @endif>{{ $d['nama'] }}</option>
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
                                            <option value="{{ $d['id'] }}" @if(!empty($d['id']==$data['dosen2_id'])) selected @endif>{{ $d['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label" for="judul_skripsi">Judul Skripsi</label>
                                    <div class="col-sm-9">
                                        <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="10">{{ $data->judul_skripsi }}</textarea>
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
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Fotocopy Kwitansi Bimbingan TA (dari awal pengambilan)</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_1 }}</p>
                                @if ($data->status_1 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_1 == 2)
                                <input type="file" name="syarat_1" class="col-sm-3" id="syarat_1">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Fotocopy Kwitansi Sidang TA</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_2 }}</p>
                                @if ($data->status_2 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_2 == 2)
                                <input type="file" name="syarat_2" class="col-sm-3" id="syarat_2">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Fotocopy Kwitansi Seminar TA</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_3 }}</p>
                                @if ($data->status_3 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_3 == 2)
                                <input type="file" name="syarat_3" class="col-sm-3" id="syarat_3">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Fotocopy Sertifikat Pesantren Calon Sarjana (paling lama 1 Tahun setelah terbit)</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_4 }}</p>
                                @if ($data->status_4 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_4 == 2)
                                <input type="file" name="syarat_4" class="col-sm-3" id="syarat_4">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Formulir Rencana Studi (FRS)</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_5 }}</p>
                                @if ($data->status_5 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_5 == 2)
                                <input type="file" name="syarat_5" class="col-sm-3" id="syarat_5">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Bukti Penyerahan Draft TA (4 Eksemplar) Memakai Mika Biru</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_6 }}</p>
                                @if ($data->status_6 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_6 == 2)
                                <input type="file" name="syarat_6" class="col-sm-3" id="syarat_6">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Bukti Bebas Perpustakaan Pusat UNISBA</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_7 }}</p>
                                @if ($data->status_7 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_7 == 2)
                                <input type="file" name="syarat_7" class="col-sm-3" id="syarat_7">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Bukti Bebas Perpustakaan TI</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_8 }}</p>
                                @if ($data->status_8 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_8 == 2)
                                <input type="file" name="syarat_8" class="col-sm-3" id="syarat_8">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Transkrip Nilai Terakhir</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_9 }}</p>
                                @if ($data->status_9 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_9 == 2)
                                <input type="file" name="syarat_9" class="col-sm-3" id="syarat_9">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Persetujuan Sidang dari Dosen Pembimbing (Kartu Bimbingan Asli)</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_10 }}</p>
                                @if ($data->status_10 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_10 == 2)
                                <input type="file" name="syarat_10" class="col-sm-3" id="syarat_10">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Fotocopy Sertifikat TOEFL (paling lama 1 Tahun setelah terbit)</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_11 }}</p>
                                @if ($data->status_11 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_11 == 2)
                                <input type="file" name="syarat_11" class="col-sm-3" id="syarat_11">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Foto Berwarna / Latar Belakang Biru berukuran 3x4 = 4 buah</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_12 }}</p>
                                @if ($data->status_12 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_12 == 2)
                                <input type="file" name="syarat_12" class="col-sm-3" id="syarat_12">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Bukti Bebas Pinjaman / Tunggakan</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_13 }}</p>
                                @if ($data->status_13 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_13 == 2)
                                <input type="file" name="syarat_13" class="col-sm-3" id="syarat_13">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Menghadiri Seminar / Sidang minimal 3 kali</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_14 }}</p>
                                @if ($data->status_14 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_14 == 2)
                                <input type="file" name="syarat_14" class="col-sm-3" id="syarat_14">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Form Hafalan Surat Al-Quran (minimal 25 surat)</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_15 }}</p>
                                @if ($data->status_15 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_15 == 2)
                                <input type="file" name="syarat_15" class="col-sm-3" id="syarat_15">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Print out bukti pengecekan Plagiarisme < 25% (sebelum sidang)</label>
                                        <p class="col-sm-5 col-form-label ">{{ $data->syarat_16 }}</p>
                                        @if ($data->status_16 == 1)
                                        <span class="label bg-green col-sm-1">Diterima</span>
                                        @else
                                        <span class="label bg-red col-sm-1">Ditolak</span>
                                        @endif

                                        @if ($data->status_16 == 2)
                                        <input type="file" name="syarat_16" class="col-sm-3" id="syarat_16">
                                        @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label">Sertifikat SKKFT yang ditandatangani oleh Wadek III</label>
                                <p class="col-sm-5 col-form-label ">{{ $data->syarat_17 }}</p>
                                @if ($data->status_17 == 1)
                                <span class="label bg-green col-sm-1">Diterima</span>
                                @else
                                <span class="label bg-red col-sm-1">Ditolak</span>
                                @endif

                                @if ($data->status_17 == 2)
                                <input type="file" name="syarat_17" class="col-sm-3" id="syarat_17">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info btn-flat">Ajukan</button>
                        <a href="{{ route('sidang_ti.index') }}" class="btn btn-link">Batal</a>

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