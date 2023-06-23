@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <button onclick="addForm('{{ route('admin.store') }}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                        <button onclick="deleteSelected('{{ route('admin.delete-selected') }}')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-admin">@csrf
                        <table class="table table-striped table-bordered table-admin">
                            <thead>
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">No</th>
                                <th>Foto Profil</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status Superadmin</th>
                                <th width="15%"><i class="fa fa-cogs"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@includeIf('admin.form')

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-admin').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("admin.data") }}',

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

        $('[name=select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        })

    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Data Admin');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin akan menghapus data terpilih?')) {
                $.post(url, $('.form-admin').serialize())
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        } else {
            alert('Pilih data yang akan dihapus');
            return;
        }
    }
</script>
@endpush