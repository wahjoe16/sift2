@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Semester</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('semester.store') }}')" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-semester">
                    <thead>
                        <th width="5%">No</th>
                        <th>Semester</th>
                        <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('semester.form')

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {

        table = $('.table-semester').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("semester.data") }}',
            },
            columns: [

                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'semester'
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
        $('#modal-form .modal-title').text('Tambah Data Semester');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }
</script>
@endpush