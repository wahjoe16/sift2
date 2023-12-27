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
            <form action="{{ route('downloadSelected') }}" method="post">@csrf
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3>Download Dokumen Sidang Pembahasan</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-download-seminar display nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Tahun Akademik</th>
                                        <th>Semester</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat1"></th>
                                        <th>Lembar bimbingan skripsi</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat2"></th>
                                        <th>Sertifikat pesantren mahasiswa baru</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat3"></th>
                                        <th>Sertifikat pesantren calon sarjana</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat4"></th>
                                        <th>Transkrip nilai</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat5"></th>
                                        <th>Sertifikat TOEFL</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat6"></th>
                                        <th>Bukti bebas pinjaman perpustakaan</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat7"></th>
                                        <th>Sertifikat SKKFT</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat8"></th>
                                        <th>Bukti KRS</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat9"></th>
                                        <th>Bukti pembayaran DPP Mk. Skripsi</th>
                                        <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th>
                                        <th>Bukti pembayaran sidang pembahasan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group">
                            <button class="btn btn-success btn-sm btn-flat btn-download"><i class="fa fa-download"></i> Download Selected</button>
                            <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    let table;

    $(function() {
        table = $('.table-download-seminar').DataTable({
            processing: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('seminarPwkDownload.data') }}",

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
                    data: 'select_all_syarat1',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_1'
                },
                {
                    data: 'select_all_syarat2',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_2'
                },
                {
                    data: 'select_all_syarat3',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_3'
                },
                {
                    data: 'select_all_syarat4',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_4'
                },
                {
                    data: 'select_all_syarat5',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_5'
                },
                {
                    data: 'select_all_syarat6',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_6'
                },
                {
                    data: 'select_all_syarat7',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_7'
                },
                {
                    data: 'select_all_syarat8',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_8'
                },
                {
                    data: 'select_all_syarat9',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_9'
                },
                {
                    data: 'select_all_syarat10',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'syarat_10'
                },
            ]
        })



        // looping select checkboxes document
        for (let nomor = 1; nomor <= 10; nomor++) {
            $('.select_all_syarat' + nomor).on('click', function() {
                console.log($(this).prop('checked'));
                $('.syarat' + nomor).prop('checked', $(this).prop('checked'));
            })

            $('.syarat' + nomor).on('change', function() {
                if (false == $(this).prop('checked')) {
                    $('.select_all_syarat' + nomor).prop('checked', false);
                }
            })
        }



    })
</script>
@endpush