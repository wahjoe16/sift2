@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-users">
                        @csrf
                        <table class="table table-striped table-bordered table-users">
                            <thead>
                                <th width="5%">No</th>
                                <th>Foto Profil</th>
                                <th>NIK/NPM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Jabatan</th>
                                <th width="7%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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