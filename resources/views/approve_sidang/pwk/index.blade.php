@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Approval Sidang Terbuka</h3>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('sidangPwkDownload.index') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-download"></i> Unduh Dokumen</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-approve-seminar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="15%"><i class="fa fa-cogs"></i> Approve</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h3>Data Rekapitulasi Sidang Terbuka</h3>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('sidangPwkDownload.index') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-download"></i> Unduh Dokumen</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <div class="col-md-12">
                        <form action="">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tahunajaran">Filter Tahun Akademik</label>
                                    <select name="tahunajaran" id="tahunajaran" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($ta as $t)
                                        <option value="{{ $t->id }}">{{ $t->tahun_ajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
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
                    </div>
                    <table class="table table-striped table-bordered table-rekap-seminar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('sidangPwkExcel.export') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                        <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@includeIf('mahasiswa.form')

@endsection

@push('scripts_page')

<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    let table, table1;

    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()

        table1 = $('.table-rekap-seminar').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('rekap-sidangPwk.data') }}",
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
                    data: 'mahasiswa.nik'
                },
                {
                    data: 'mahasiswa.nama'
                },
                {
                    data: 'tahun_ajaran.tahun_ajaran'
                },
                {
                    data: 'semester.semester'
                },
                {
                    data: 'tanggal_pengajuan'
                },
                {
                    data: 'aksi'
                }
            ]
        })

        $('#tahunajaran').change(function() {
            table1.ajax.reload();
            // table.column(3).search($(this).val()).draw();
        })

        $('#semester').change(function() {
            table1.ajax.reload();
            // table.column(4).search($(this).val()).draw();
        })


        table = $('.table-approve-seminar').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('view-sidangPwk.data') }}"
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
                    data: 'tanggal_pengajuan'
                },
                {
                    data: 'approve'
                }
            ]
        })
    })
</script>
@endpush