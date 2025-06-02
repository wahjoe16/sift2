@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Sistem Informasi Fakultas Teknik UNISBA</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats card-primary card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Dosen</p>
                            <h4 class="card-title">{{ $dosen }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats card-success card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Mahasiswa</p>
                            <h4 class="card-title">{{ $mhs }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats card-warning card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="fas fa-street-view"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Tenaga Kependidikan</p>
                            <h4 class="card-title">{{ $admin }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats card-danger card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="icon-big text-center">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="col-8 col-stats">
                        <div class="numbers">
                            <p class="card-category">Arsip Fakultas</p>
                            <h4 class="card-title">{{ $arsip }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Kelulusan Mahasiswa</h4>
            </div>
            <div class="card-body">
                {!! $trenLulusanChart->container() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Rekap Kelulusan Mahasiswa</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-rekap">
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
            <div class="card-footer">
                <div class="btn-group">
                    <a href="{{ route('lulusanExcel.export') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sebaran Mahasiswa</h4>
            </div>
            <div class="card-body">
                {!! $mahasiswaPieChart->container() !!}
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sebaran Dosen</h4>
            </div>
            <div class="card-body">
                {!! $dosenPieChart->container() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card">
            <div class="card-header">
                <h4>Mahasiswa</h4>
            </div>
            <div class="card-body table-responsive">
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Dosen</h4>
            </div>
            <div class="card-body table-responsive">
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