@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <button onclick="addForm('{{ route('dosen.store') }}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                        <a href="{{ route('dosen.import-page') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-upload"></i> Import</a>
                        <button onclick="deleteSelected('{{ route('dosen.delete-selected') }}')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-admin">
                        <table class="table table-striped table-bordered table-dosen">
                            <thead>
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">No</th>
                                <th>Foto Profil</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Email</th>
                                <th width="15%"><i class="fa fa-cogs"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@includeIf('dosen.form')

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-dosen').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("dosen.data") }}',
            },
            columns: [{
                    data: 'select_all',
                },
                {
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
        });

        $('#modal-form').validator().on('submit', function(e) {
            if (!e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Dosen');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nik]').focus();
    }
</script>
@endpush