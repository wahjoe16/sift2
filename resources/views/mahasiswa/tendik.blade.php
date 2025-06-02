@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Mahasiswa</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-mahasiswa">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Foto Profil</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Email</th>
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
    let table;

    $(function() {

        table = $('.table-mahasiswa').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("tendikDataMahasiswa") }}',

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
                    data: 'email'
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