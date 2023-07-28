@extends('layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Data Bimbingan Sidang Sistem Informasi Fakultas Teknik</b>
    </h1>
    <ol class="breadcrumb">
        @section('breadcrumb')
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        @show
    </ol>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h4>Data Pembimbingan 1</h4>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered table-bimbingan-1">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th width="5%"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                        <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h4>Data Pembimbingan 2</h4>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered table-bimbingan-2">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th width="5%"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                        <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')

<script>
    let table1, table2;

    $(function() {
        table1 = $('.table-bimbingan-1').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("bimbinganPwk.data1") }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
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
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        })

        table2 = $('.table-bimbingan-2').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("bimbinganPwk.data2") }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
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
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        })
    })
</script>

@endpush