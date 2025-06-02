@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Pengajuan Kegiatan SKKFT</h3>
    </div>
</div>

@include('layouts.alert') 

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="display table table-striped table-hover table-kegiatan_skkft">
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