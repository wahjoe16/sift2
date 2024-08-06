@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Database Alumni Fakultas Teknik</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        {{-- <button onclick="addForm('{{ route('mahasiswa.store') }}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button> --}}
                        <a href="{{ route('alumni.create') }}" class="btn btn-success btn-flat btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                        <a href="{{ route('alumni.import-page') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-upload"></i> Import</a>
                        {{-- <button onclick="deleteSelected('{{ route('mahasiswa.delete-selected') }}')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</button> --}}
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-mahasiswa">@csrf
                        <table class="table table-striped table-bordered table-alumni">
                            <thead>
                                <tr>
                                    {{-- <th width="5%">
                                        <input type="checkbox" name="select_all" id="select_all">
                                    </th> --}}
                                    <th width="7%">No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Email</th>
                                    <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- @includeIf('mahasiswa.form') --}}

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-alumni').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("alumni.data") }}',

            },
            columns: [
                // {
                //     data: 'select_all',
                // },
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
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
                    data: 'email',
                    defaultContent: 'N/A',
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