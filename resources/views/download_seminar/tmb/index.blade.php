@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

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
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3>Download Dokumen Kolokium Skripsi</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <form action="">
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="tahunajaran">Filter Tahun Akademik</label>
                                    <select name="tahunajaran" id="tahunajaran" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($ta as $t)
                                        <option value="{{ $t->id }}">{{ $t->tahun_ajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="semester">Filter Semester</label>
                                    <select name="semester" id="semester" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($smt as $s)
                                        <option value="{{ $s->id }}">{{ $s->semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered table-download-seminar display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Tahun Akademik</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat1"></th> -->
                                    <th>Bukti pembayaran Kolokium Skripsi</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat2"></th> -->
                                    <th>Sertifikat TOEFL</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat3"></th> -->
                                    <th>Formulir nilai bimbingan skripsi</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat4"></th> -->
                                    <th>Formulir kemajuan bimbingan skripsi</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat5"></th> -->
                                    <th>Formulir persetujuan kolokium skripsi</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat6"></th> -->
                                    <th>Formulir kesediaan menghadiri kolokium skripsi</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat7"></th> -->
                                    <th>Pas foto ukuran 4 x 6 sebanyak 2 lembar</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat8"></th> -->
                                    <th>Kartu Tanda Mahasiswa</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat9"></th> -->
                                    <th>Bukti pembayaran kuliah</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Bukti perwalian</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Bukti bebas pinjaman perpustakaan</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Draft skripsi (PDF)</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Draft skripsi (DOCX)</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Transkrip Nilai</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <!-- <button class="btn btn-success btn-sm btn-flat btn-download"><i class="fa fa-download"></i> Download Selected</button> -->
                        <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    let table;

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        table = $('.table-download-seminar').DataTable({
            processing: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('seminarTmbDownload.data') }}",
                data: function(d) {
                    d.tahun_ajaran_id = $('#tahunajaran').val();
                    d.semester_id = $('#semester').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'tahun_ajaran'
                },
                {
                    data: 'semester'
                },
                {
                    data: 'status'
                },

                {
                    data: 'syarat_1'
                },

                {
                    data: 'syarat_2'
                },

                {
                    data: 'syarat_3'
                },

                {
                    data: 'syarat_4'
                },

                {
                    data: 'syarat_5'
                },

                {
                    data: 'syarat_6'
                },

                {
                    data: 'syarat_7'
                },

                {
                    data: 'syarat_8'
                },

                {
                    data: 'syarat_9'
                },
                {
                    data: 'syarat_10'
                },
                {
                    data: 'syarat_11'
                },
                {
                    data: 'syarat_12'
                },
                {
                    data: 'syarat_13'
                },
                {
                    data: 'syarat_14'
                },
            ]
        })

        $('#tahunajaran').change(function() {
            table.ajax.reload();
            // table.column(3).search($(this).val()).draw();
        })

        $('#semester').change(function() {
            table.ajax.reload();
            // table.column(4).search($(this).val()).draw();
        })

        // looping select checkboxes document
        // for (let nomor = 1; nomor <= 10; nomor++) {
        //     $('.select_all_syarat' + nomor).on('click', function() {
        //         console.log($(this).prop('checked'));
        //         $('.syarat' + nomor).prop('checked', $(this).prop('checked'));
        //     })

        //     $('.syarat' + nomor).on('change', function() {
        //         if (false == $(this).prop('checked')) {
        //             $('.select_all_syarat' + nomor).prop('checked', false);
        //         }
        //     })
        // }

    })
</script>
@endpush