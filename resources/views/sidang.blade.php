@extends('layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Dokumentasi Persyaratan Sidang Sistem Informasi Fakultas Teknik</b>
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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Grafik Kelulusan Mahasiswa</h4>
                </div>
                <div class="box-body">
                    {!! $trenLulusanChart->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Rekap Kelulusan Mahasiswa</h4>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered table-rekap">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th width="5%"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('lulusanExcel.export') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                        <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Sebaran Mahasiswa</h4>
                </div>
                <div class="box-body">
                    {!! $mahasiswaPieChart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Sebaran Dosen</h4>
                </div>
                <div class="box-body">
                    {!! $dosenPieChart->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Mahasiswa</h4>
                </div>
                <div class="box-body table-responsive">
                    <form action="">
                        <table class="table table-striped table-bordered table-mahasiswa">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Foto Profil</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th width="5%"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Dosen</h4>
                </div>
                <div class="box-body table-responsive">
                    <form action="">
                        <table class="table table-striped table-bordered table-dosen">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Foto Profil</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th width="5%"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ $mahasiswaPieChart->cdn() }}"></script>
<script src="{{ $dosenPieChart->cdn() }}"></script>
<script src="{{ $trenLulusanChart->cdn() }}"></script>

{{ $mahasiswaPieChart->script() }}
{{ $dosenPieChart->script() }}
{{ $trenLulusanChart->script() }}

@endsection

@push('scripts_page')



<script>
    let table, table1, table2;

    $(function() {
        table = $('.table-mahasiswa').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("dashboard.mahasiswa") }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'foto'
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'program_studi'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        })

        table1 = $('.table-dosen').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("dashboard.dosen") }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'foto'
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'program_studi'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        })

        table2 = $('.table-rekap').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("dashboard.rekapLulusan") }}',
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
                    data: 'mahasiswa.program_studi'
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
    });
</script>
@endpush