@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Data SKPI</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab-nobd" data-bs-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Data Pengajuan SKPI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab-nobd" data-bs-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Database SKPI</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                        <table class="table table-striped table-print_skpi">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Program Studi</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                        <table class="table table-striped table-database_skpi">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Program Studi</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')
<script>
    let table, table2;

    $(function(){
        table = $('.table-print_skpi').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("skpi.data") }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'user_skpi.nama' },
                { data: 'user_skpi.nik' },
                { data: 'user_skpi.program_studi' },
                { data: 'tanggal'},
                { data: 'aksi', sortable: false},
            ]
        });
    })

    $(function(){
        table2 = $('.table-database_skpi').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("skpi.data-accept") }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'user_skpi.nama' },
                { data: 'user_skpi.nik' },
                { data: 'user_skpi.program_studi' },
                { data: 'tanggal'},
                { data: 'aksi', sortable: false},
            ]
        });
    })
</script>
@endpush