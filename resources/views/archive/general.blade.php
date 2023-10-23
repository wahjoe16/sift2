@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Arsip Umum Fakultas Teknik</h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="col-md-12">
                        <form action="">
                            <div class="form-row">
                                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                    <label for="tahunajaran">Filter Tahun Akademik</label>
                                    <select name="tahunajaran" id="tahunajaran" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($ta as $t)
                                        <option value="{{ $t->id }}">{{ $t->tahun_ajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                    <label for="semester">Filter Semester</label>
                                    <select name="semester" id="semester" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($smt as $s)
                                        <option value="{{ $s->id }}">{{ $s->semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                    <label for="kategori">Filter Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                    <label for="subkategori">Filter Sub-Kategori</label>
                                    <select name="subkategori" id="subkategori" class="form-control select2">
                                        <option value="">Pilih</option>
                                        @foreach ($subcategory as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-striped table-bordered table-general-archive">
                        <thead>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Kategori Arsip</th>
                            <th>Sub Kategori Arsip</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th width="16%"><i class="fa fa-cogs"></i> Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')

<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    let table;

    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()

        table = $('.table-general-archive').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("ft-arsip-general.data") }}',
                data: function(d) {
                    d.tahun_ajaran_id = $('#tahunajaran').val();
                    d.semester_id = $('#semester').val();
                    d.category_archive_id = $('#kategori').val();
                    d.subcategory_archive_id = $('#subkategori').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'section.name'
                },
                {
                    data: 'category_archive.name'
                },
                {
                    data: 'subcategory_archive.name'
                },
                {
                    data: 'tahun_ajaran.tahun_ajaran'
                },
                {
                    data: 'semester.semester'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
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
</script>

<!-- Dependent dropdown -->
<script>
    jQuery('select[name="kategori"]').on('change', function() {
        var subcategory = jQuery(this).val();
        if (subcategory) {
            jQuery.ajax({
                url: '/archives/dropdownlist/sub-category-archive/' + subcategory,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="subkategori"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="subkategori"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
            })
        } else {
            $('select[name="subkategori"]').empty();
        }
    })
</script>
<!-- end of dependen dropsown -->
@endpush