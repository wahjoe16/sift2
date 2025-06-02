@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Data Bimbingan</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Pembimbingan 1</h5>
            </div>
            <div class="card-body">
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
            <div class="card-footer">
                <div class="btn-group">
                    <a href="" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Bimbingan 2</h5>
            </div>
            <div class="card-body">
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
            <div class="card-footer">
                <div class="btn-group">
                    <a href="" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')

<script>
    let table1, table2;

    $(function() {
        table1 = $('.table-bimbingan-1').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("bimbinganTi.data1") }}',
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
                url: '{{ route("bimbinganTi.data2") }}',
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