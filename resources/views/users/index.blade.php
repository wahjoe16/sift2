@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">All Users</h3>
    </div>
</div>

@includeIf('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover table-users">
                        <thead>
                            <tr>
                                <th>Foto Profil</th>
                                <th>NIK/NPM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Jabatan</th>
                                <th width="5%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto Profil</th>
                                <th>NIK/NPM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Jabatan</th>
                                <th width="5%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        // datatable dosen
        table = $('.table-users').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("users.data") }}',
            },
            columns: [
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
                    data: 'level'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        });

    });
</script>
@endpush