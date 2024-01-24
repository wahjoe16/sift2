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
        <div class="col-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Download Dokumen Sidang Tugas Akhir</h3>
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
                        <table class="table table-striped table-bordered table-download-sidang display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Tahun Akademik</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat1"></th> -->
                                    <th>Fotocopy Kwitansi Bimbingan TA</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat2"></th> -->
                                    <th>Fotocopy Kwitansi Sidang TA</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat3"></th> -->
                                    <th>Fotocopy Kwitansi Seminar TA</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat4"></th> -->
                                    <th>Fotocopy Sertifikat Pesantren Calon Sarjana</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat5"></th> -->
                                    <th>Formulir Rencana Studi (FRS)</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat6"></th> -->
                                    <th>Bukti Penyerahan Draft TA</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat7"></th> -->
                                    <th>Bukti Bebas Perpustakaan Pusat UNISBA</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat8"></th> -->
                                    <th>Bukti Bebas Perpustakaan TI</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat9"></th> -->
                                    <th>Transkrip Nilai Terakhir</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Persetujuan Sidang dari Dosen Pembimbing</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Fotocopy Sertifikat TOEFL</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Foto</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Bukti Bebas Pinjaman / Tunggakan</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Menghadiri Seminar / Sidang</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Form Hafalan Surat Al-Quran</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Print out bukti pengecekan Plagiarisme</th>
                                    <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                                    <th>Sertifikat SKKFT</th>
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

        table = $('.table-download-sidang').DataTable({
            processing: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('sidangTiDownload.data') }}",
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
                {
                    data: 'syarat_15'
                },
                {
                    data: 'syarat_16'
                },
                {
                    data: 'syarat_17'
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