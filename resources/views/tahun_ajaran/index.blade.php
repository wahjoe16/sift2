@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Tahun Akademik</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('tahunajaran.store') }}')" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" class="form-admin">@csrf
                    <table class="table table-striped table-bordered table-tahun-ajaran">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tahun Akademik</th>
                            <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@include('tahun_ajaran.form')

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
        $('#modal-form .modal-title').text('Tambah Data Tahun Akademik');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }
</script>
@endpush