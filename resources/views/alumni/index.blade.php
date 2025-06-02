@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Database Alumni Fakultas Teknik</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    {{-- <button onclick="addForm('{{ route('mahasiswa.store') }}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button> --}}
                    <a href="{{ route('alumni.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                    <a href="{{ route('alumni.import-page') }}" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> Import</a>
                    {{-- <button onclick="deleteSelected('{{ route('mahasiswa.delete-selected') }}')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</button> --}}
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-alumni">
                    <thead>
                        <tr>
                            {{-- <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th> --}}
                            <th width="7%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Handphone</th>
                            <th width="15%"><i class="fas fa-cogs"></i> Aksi</th>
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
                    data: 'nama'
                },
                {
                    data: 'email',
                    defaultContent: 'N/A',
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'no_hp'
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