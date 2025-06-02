@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Seminar Tugas Akhir</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('seminarTiDownload.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Unduh Dokumen</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-approve-seminar">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row  mt-4">
    <div>
        <h3 class="fw-bold">Sidang Tugas Akhir</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('sidangTiDownload.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Unduh Dokumen</a>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatables" class="display table table-striped table-hover table-approve-sidang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')
<script>
    let table, table2;

    $(function() {
        table = $('.table-approve-seminar').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('adminSeminarTi.data') }}"
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
                    data: 'status'
                },
                {
                    data: 'approve'
                }
            ]
        })

        table2 = $('.table-approve-sidang').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('adminSidangTi.data') }}"
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
                    data: 'status'
                },
                {
                    data: 'approve'
                }
            ]
        })
    })
</script>
@endpush