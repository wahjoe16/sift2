@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Rekap SKKFT <strong>{{ $data->user_skpi->nama }}</strong></h3>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Kegiatan</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-skkft">
                    <thead>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Tingkat</th>
                        <th>Prestasi</th>
                        <th>Jabatan</th>
                        <th>Bukti Fisik</th>
                    </thead>
                    <tfoot>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Tingkat</th>
                        <th>Prestasi</th>
                        <th>Jabatan</th>
                        <th>Bukti Fisik</th>
                    </tfoot>
                    <tbody>
                        @foreach ($dataKegiatan as $d)
                            <tr>
                                <td>{{ $d->nama_kegiatan }}</td>
                                <td>{{ $d->categories_skkft->category_name }}</td>
                                <td>{{ $d->subcategories_skkft->subcategory_name }}</td>
                                <td>
                                    @if ($d->tingkat_id != '')
                                        {{ $d->tingkat_skkft->tingkat }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($d->prestasi_id != '')
                                        {{ $d->prestasi_skkft->prestasi }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($d->jabatan_id != '')
                                        {{ $d->jabatan_skkft->jabatan }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center"><a href="{{ asset('storage/' . $d->bukti_fisik) }}" target="_blank"><i class="fa fa-link"></i></a></td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('skpi.update', $data->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Cetak Data SKPI</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Mahasiswa</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ $data->user_skpi->nama }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="program_studi">Program Studi</label>
                                <input type="text" name="program_studi" class="form-control" id="program_studi" value="{{ $data->user_skpi->program_studi }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" @if($data->user_skpi->tempat_lahir != '') value="{{ $data->user_skpi->tempat_lahir }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="no_skpi">Nomor SKPI</label>
                                <input type="text" name="no_skpi" class="form-control" id="no_skpi" placeholder="Nomor SKPI" value="{{ $data->no_skpi }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk Perkuliahan</label>
                                <input type="text" name="tanggal_masuk" class="form-control" id="tanggal" placeholder="Tanggal Masuk Perkuliahan" value="{{ Carbon\Carbon::parse($data->tanggal_masuk)->format('m-d-Y') }}">
                            </div>
                            <div class="form-group">
                                <label for="akre_prodi">Akreditasi Program Studi</label>
                                <select name="akre_prodi" id="akre_prodi" class="form-control text-black">
                                    <option value="">Select</option>
                                        @foreach ([
                                            "Unggul"=>"Unggul",
                                            "Baik Sekali"=>"Baik Sekali",
                                            "Baik"=>"Baik",
                                            "Tak Terakreditasi"=>"Tak Terakreditasi"
                                            ] as $akre_prodi => $akre_prodiLabel)
                                            <option value="{{ $akre_prodi }}" {{ old('akre_prodi', $data->akreditasi_prodi)==$akre_prodi ? "selected" : "" }}>{{ $akre_prodiLabel }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NPM</label>
                                <input type="text" name="nik" class="form-control" id="nik" value="{{ $data->user_skpi->nik }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>
                                <input type="text" name="fakultas" class="form-control" id="fakultas" value="Fakultas Teknik" disabled>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="text" name="tanggal_lahir" class="form-control" id="tanggal2" placeholder="Tanggal Lahir" @if($data->user_skpi->tanggal_lahir != '') value="{{ Carbon\Carbon::parse($data->user_skpi->tanggal_lahir)->format('m-d-Y') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="no_ijazah">Nomor Ijazah</label>
                                <input type="text" name="no_ijazah" class="form-control" id="no_ijazah" placeholder="Nomor Ijazah" value="{{ $data->no_ijazah }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lulus">Tanggal Lulus Perkuliahan</label>
                                <input type="text" name="tanggal_lulus" class="form-control" id="tanggal3" placeholder="Tanggal Lulus Perkuliahan" value="{{ Carbon\Carbon::parse($data->tanggal_lulus)->format('m-d-Y') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-info"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('skpi.print', $data->id) }}" class="btn btn-sm btn-flat btn-success" @if($data->status_cetak == 0) disabled @endif><i class="fa fa-print"></i> Cetak</a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('kai/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Date picker -->
<!-- bootstrap datepicker -->
<script src="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Date picker
        $('#tanggal').datepicker({
            autoclose: true
        })

        //Date picker
        $('#tanggal2').datepicker({
            autoclose: true
        })

        //Date picker
        $('#tanggal3').datepicker({
            autoclose: true
        })
    })
</script>

@endpush