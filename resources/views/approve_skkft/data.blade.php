@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Database Kegiatan SKKFT</h3>
</section>
<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-kegiatan_skkft">
                        <thead>
                            <th width="5%">No</th>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Kegiatan</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    let table;

    $(function(){
        table = $('.table-kegiatan_skkft').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dataSkkft.data") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'user_skkft.nik' },
                { data: 'user_skkft.nama' },
                { data: 'nama_kegiatan' },
                { data: 'categories_skkft.category_name' },
                { data: 'subcategories_skkft.subcategory_name'},
                { data: 'aksi', sortable: false, orderable: false },
            ]
        })               
    })
</script>
@endpush