@extends('layouts.master')

@push('css_page')
<style>
    div.dataTables_wrapper {
        width: 980px;
        margin: 0 auto;
    }
</style> 
@endpush

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h2>Edit Profil Dosen</h2>
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    
                </div>
                <div class="box-body table-responsive">
                    <form action="{{ route('dosen.updateAll') }}" method="post" class="form-dosen">
                        @csrf
                        <table class="table table-striped table-bordered table-dosen display nowrap" style="width: 100%;">
                            <thead>
                                <th width="5%">No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Pendidikan</th>
                                <th>Jabatan Fungsional</th>
                                <th>Kelompok Keahlian</th>
                            </thead>
                            <tbody>
                                @foreach ($dosen as $index => $val)
                                <tr>
                                    <input type="hidden" name="dosen_id[]" value="{{ $val->id }}">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $val->nik }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td>{{ $val->program_studi }}</td>
                                    <td>
                                        <select name="class_pendidikan[]" id="" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach (["S2"=>"S2", "S3"=>"S3"] as $pendidikan => $pendidikanLabel)
                                                <option value="{{ $pendidikan }}">{{ $pendidikanLabel }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="class_jabfung[]" id="" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach (["Tenaga Pengajar"=>"Tenaga Pengajar",
                                                        "Asisten Ahli"=>"Asisten Ahli", 
                                                        "Lektor"=>"Lektor", 
                                                        "Lektor Kepala"=>"Lektor Kepala", 
                                                        "Guru Besar/Professor"=>"Guru Besar/Professor"
                                                    ] as $jabfung => $jabfungLabel)
                                                <option value="{{ $jabfung }}">{{ $jabfungLabel }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="kelompok_keahlian[]" id="" class="form-control">
                                            <option value="">Pilih</option>
                                            <optgroup label="Teknik Pertambangan">
                                                @foreach ([
                                                    "Geologi Eksplorasi"=>"Geologi Eksplorasi", 
                                                    "Tambang Umum"=>"Tambang Umum", 
                                                    "Pengolahan Bahan Galian"=>"Pengolahan Bahan Galian"
                                                ] as $kelompok_keahlian_tmb=>$kelompok_keahlian_tmbLabel)
                                                <option value="{{ $kelompok_keahlian_tmb }}">{{ $kelompok_keahlian_tmbLabel }}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Teknik Industri">
                                                @foreach ([
                                                    "Keahlian Ergonomi dan Rekayasa Kerja"=>"Keahlian Ergonomi dan Rekayasa Kerja", 
                                                    "Manajemen Industri"=>"Manajemen Industri", 
                                                    "Sistem Industri dan Tekno-Ekonomi"=>"Sistem Industri dan Tekno-Ekonomi",
                                                    "Sistem Manufaktur"=>"Sistem Manufaktur"
                                                ] as $kelompok_keahlian_ti=>$kelompok_keahlian_tiLabel)
                                                <option value="{{ $kelompok_keahlian_ti }}">{{ $kelompok_keahlian_tiLabel }}</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Perencanaan Wilayah dan Kota">
                                                @foreach ([
                                                    "Kota"=>"Kota", 
                                                    "Transportasi"=>"Transportasi", 
                                                    "Lingkungan"=>"Lingkungan",
                                                    "Pariwisata"=>"Pariwisata",
                                                    "Rekayasa Pedesaan"=>"Rekayasa Pedesaan"
                                                ] as $kelompok_keahlian_pwk=>$kelompok_keahlian_pwkLabel)
                                                <option value="{{ $kelompok_keahlian_pwk }}">{{ $kelompok_keahlian_pwkLabel }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <div class="form-group row">
                            
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    // let table;

    // $(function() {

    //     // datatable dosen
    //     table = $('.table-dosen').DataTable({
    //         processing: true,
    //         autoWidth: false,
    //         ajax: {
    //             url: '{{ route("dosen.editData") }}',
    //         },
    //         columns: [
    //             {
    //                 data: 'DT_RowIndex',
    //                 searchable: false,
    //                 sortable: false
    //             },
    //             {
    //                 data: 'nik'
    //             },
    //             {
    //                 data: 'nama'
    //             },
    //             {
    //                 data: 'program_studi'
    //             },
    //             {
    //                 data:'class_pendidikan'
    //             },
    //             {
    //                 data:'class_jabfung'
    //             },
    //             {
    //                 data:'kelompok_keahlian'
    //             },
    //         ]
    //     });

    // });

    

</script>
@endpush