@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <button onclick="addForm('{{ route('tahunajaran.store') }}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-admin">@csrf
                        <table class="table table-striped table-bordered table-tahun-ajaran">
                            <thead>
                                <th width="5%">No</th>
                                <th>Tahun Ajaran</th>
                                <th width="15%"><i class="fa fa-cogs"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@includeIf('tahun_ajaran.form')

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-tahun-ajaran').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("tahunajaran.data") }}',
            },
            columns: [

                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tahun_ajaran'
                },
                {
                    data: 'aksi'
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

        $('[name=select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        })

    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Data Tahun Ajaran');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }
</script>
@endpush