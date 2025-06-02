@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Tenaga Kependidikan</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Tenaga Kependidikan</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-admin">
                    <thead>
                        <th width="5%">No</th>
                        <th>Foto Profil</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status Super Admin</th>
                        <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-admin').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("tendikDataAdmin") }}',

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
                    data: 'email'
                },
                {
                    data: 'status_superadmin'
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