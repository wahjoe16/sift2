@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Kategori Arsip</h3>
    </div>
</div>

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('category-archive.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-category_archive">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama Bidang</th>
                        <th>Nama Kategori Arsip</th>
                        <th>Deskripsi Kategori Arsip</th>
                        <th width="9%"><i class="fas fa-cogs"></i> Aksi</th>
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
        table = $('.table-category_archive').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("category-archive.data") }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'section_id.name'
                },
                {
                    data: 'name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ]
        });
    });
</script>
@endpush