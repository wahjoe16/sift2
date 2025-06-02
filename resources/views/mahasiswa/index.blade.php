@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Data Mahasiswa</h3>
    </div>
</div>

@includeIf('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('mahasiswa.store') }}')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah</button>
                    <a href="{{ route('mahasiswa.import-page') }}" class="btn btn-sm btn-primary"><i class="fas fa-upload"></i> Import</a>
                    <button onclick="deleteSelected('{{ route('mahasiswa.delete-selected') }}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="post" class="form-mahasiswa">@csrf
                        <table id="basic-datatables" class="display table table-striped table-hover table-mahasiswa">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="select_all" id="select_all">
                                    </th>
                                    <th>Foto Profil</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th width="5%"><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="select_all" id="select_all">
                                    </th>
                                    <th>Foto Profil</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th width="5%"><i class="fas fa-cogs"></i></th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('mahasiswa.form')

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-mahasiswa').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("mahasiswa.data") }}',

            },
            columns: [{
                    data: 'select_all',
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
        $('#modal-form .modal-title').text('Tambah Data Mahasiswa');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin akan menghapus data terpilih?')) {
                $.post(url, $('.form-mahasiswa').serialize())
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