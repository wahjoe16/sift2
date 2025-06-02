@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Arsip Saya</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="tahunajaran">Filter Tahun Akademik</label>
            <select name="tahunajaran" id="tahunajaran" class="form-control select2">
                <option value="">Pilih</option>
                @foreach ($ta as $t)
                <option value="{{ $t->id }}">{{ $t->tahun_ajaran }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="semester">Filter Semester</label>
            <select name="semester" id="semester" class="form-control select2">
                <option value="">Pilih</option>
                @foreach ($smt as $s)
                <option value="{{ $s->id }}">{{ $s->semester }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="kategori">Filter Kategori</label>
            <select name="kategori" id="kategori" class="form-control select2">
                <option value="">Pilih</option>
                @foreach ($category as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="subkategori">Filter Sub-Kategori</label>
            <select name="subkategori" id="subkategori" class="form-control select2">
                <option value="">Pilih</option>
                @foreach ($subcategory as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('my-archive.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-myarchive">
                        <thead>
                            <th>Nama</th>
                            <th>Kategori Arsip</th>
                            <th>Sub Kategori Arsip</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Diupload Oleh</th>
                            <th width="16%"><i class="fa fa-cogs"></i> Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts_page')

<script src="{{ asset('kai/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    let table;

    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()

        // select all checkbox
        $('[name=select_all]').on('click', function() {
            // console.log($(this).prop('checked'));
            $(':checkbox').prop('checked', this.checked);
        })

        // dataTable arsip saya(dosen)
        table = $('.table-myarchive').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("my-archive.data") }}',
                data: function(d) {
                    d.tahun_ajaran_id = $('#tahunajaran').val();
                    d.semester_id = $('#semester').val();
                    d.category_archive_id = $('#kategori').val();
                    d.subcategory_archive_id = $('#subkategori').val();
                }
            },
            columns: [
                {
                    data: 'a_name'
                },
                
                {
                    data: 'c_name'
                },
                {
                    data: 'sa_name'
                },
                {
                    data: 'ta'
                },
                {
                    data: 'smt'
                },
                {
                    defaultContent: "N/A",
                    data: 'uu'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                }
            ]
        })

        $('#tahunajaran').change(function() {
            table.ajax.reload();
        })

        $('#semester').change(function() {
            table.ajax.reload();
        })

        $('#kategori').change(function() {
            table.ajax.reload();
        })

        $('#subkategori').change(function() {
            table.ajax.reload();
        })

    })

    function downloadSelected(url) {
        if ($('input:checked').length >= 1) {
            if (confirm('Yakin, Akan men-download data arsip yang dipilih?')) {
                $.post(url, $('.form-archive').serialize())
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat mendownload data!');
                        return;
                    })
            }
        } else {
            alert('Pilih data arsip yang akan didownload');
            return;
        }
    }
</script>
@endpush