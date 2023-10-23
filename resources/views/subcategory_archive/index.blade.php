@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('sub-category-archive.create') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-admin">@csrf
                        <table class="table table-striped table-bordered table-subcategory_archive">
                            <thead>
                                <th width="5%">No</th>
                                <th>Sesi</th>
                                <th>Kategori Arsip</th>
                                <th>Sub Kategori Arsip</th>
                                <th>Deskripsi Sub Kategori Arsip</th>
                                <th width="9%"><i class="fa fa-cogs"></i> Aksi</th>
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
        table = $('.table-subcategory_archive').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("sub-category-archive.data") }}',
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
                    data: 'category_archive_id.name'
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