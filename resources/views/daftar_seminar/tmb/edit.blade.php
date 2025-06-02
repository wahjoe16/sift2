@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Kolokium Skripsi</h3>
    </div>
</div>

@include('layouts.alert')

<form class="form-horizontal" action="{{ route('seminar_tmb.update', $data->id) }}" method="post" enctype="multipart/form-data">@csrf
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
                            <option value=" {{ $ta['id'] }}" @if (!empty($ta['id']==$data['tahun_ajaran_id'])) selected @endif>{{ $ta['tahun_ajaran'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($semester as $s)
                            <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['semester_id'])) selected @endif>{{ $s['semester'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosen1_id">Dosen Pembimbing 1</label>
                        <select name="dosen1_id" id="dosen1_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($dosen1 as $d)
                            <option value="{{ $d['id'] }}" @if(!empty($d['id']==$data['dosen1_id'])) selected @endif>{{ $d['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosen2_id">Dosen Pembimbing 2</label>
                        <select name="dosen2_id" id="dosen2_id" class="form-control select2">
                            <option value="">Pilih</option>
                            @foreach($dosen2 as $d)
                            <option value="{{ $d['id'] }}" @if(!empty($d['id']==$data['dosen2_id'])) selected @endif>{{ $d['nama'] }}</option>
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
                    <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="13">{{ $data->judul_skripsi }}</textarea>
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
                    <h5>Upload Persyaratan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Nama File</th>
                            <th>Status</th>
                            <th>Upload</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_1) }}">Bukti pembayaran Kolokium Skripsi</a></td>
                                <td>
                                    @if ($data->status_1 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_1 == 2)
                                        <input type="file" name="syarat_1" id="syarat_1">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_2) }}">Sertifikat TOEFL</a></td>
                                <td>
                                    @if ($data->status_2 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_2 == 2)
                                        <input type="file" name="syarat_2" id="syarat_2">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_3) }}">Formulir nilai bimbingan skripsi</a></td>
                                <td>
                                    @if ($data->status_3 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_3 == 2)
                                        <input type="file" name="syarat_3" id="syarat_3">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_4) }}">Formulir kemajuan bimbingan skripsi</a></td>
                                <td>
                                    @if ($data->status_4 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_4 == 2)
                                        <input type="file" name="syarat_4" id="syarat_4">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_5) }}">Formulir persetujuan kolokium skripsi</a></td>
                                <td>
                                    @if ($data->status_5 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_5 == 2)
                                        <input type="file" name="syarat_5" id="syarat_5">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_6) }}">Formulir kesediaan menghadiri kolokium skripsi</a></td>
                                <td>
                                    @if ($data->status_6 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_6 == 2)
                                        <input type="file" name="syarat_6" id="syarat_6">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_7) }}">Pas foto ukuran 4 x 6 sebanyak 2 lembar</a></td>
                                <td>
                                    @if ($data->status_7 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_7 == 2)
                                        <input type="file" name="syarat_7" id="syarat_7">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_8) }}">Kartu Tanda Mahasiswa</a></td>
                                <td>
                                    @if ($data->status_8 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_8 == 2)
                                        <input type="file" name="syarat_8" id="syarat_8">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_9) }}">Bukti pembayaran kuliah</a></td>
                                <td>
                                    @if ($data->status_9 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_9 == 2)
                                        <input type="file" name="syarat_9" id="syarat_9">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_10) }}">Bukti perwalian</a></td>
                                <td>
                                    @if ($data->status_10 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_10 == 2)
                                        <input type="file" name="syarat_10" id="syarat_10">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_11) }}">Bukti bebas pinjaman perpustakaan</a></td>
                                <td>
                                    @if ($data->status_11 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_11 == 2)
                                        <input type="file" name="syarat_11" id="syarat_11">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_12) }}">Draft skripsi (PDF)</a></td>
                                <td>
                                    @if ($data->status_12 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_12 == 2)
                                        <input type="file" name="syarat_12" id="syarat_12">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_13) }}">Draft skripsi (DOCX)</a></td>
                                <td>
                                    @if ($data->status_13 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_13 == 2)
                                        <input type="file" name="syarat_13" id="syarat_13">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('/mahasiswa/seminar', $data->syarat_14) }}">Transkrip Nilai <sub>(Dicap dan ditanda tangan Operator SIAA)</a></td>
                                <td>
                                    @if ($data->status_14 == 1)
                                    <span class="badge badge-success">Diterima</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status_14 == 2)
                                        <input type="file" name="syarat_14" id="syarat_14">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-info btn-flat">Ajukan</button>
            <a href="{{ route('seminar_tmb.index') }}" class="btn btn-link">Batal</a>
        </div>
    </div>
</form>

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