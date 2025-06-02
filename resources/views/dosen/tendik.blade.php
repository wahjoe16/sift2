@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Dosen</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Dosen</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-dosen">
                    <thead>
                        <th>Foto Profil</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Email</th>
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
        // datatable dosen
        table = $('.table-dosen').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("tendikDataDosen") }}',
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
                    data: 'email'
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