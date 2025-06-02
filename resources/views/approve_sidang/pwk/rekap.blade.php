@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Lulusan Program Studi Perencanaan Wilayah dan Kota</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
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
    <div class="col-md-6">
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <a href="{{ route('sidangPwkDownload.index') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-download"></i> Unduh Dokumen</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-rekap-seminar">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Tanggal Pengajuan</th>
                            <th width="15%"><i class="fas fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <a href="{{ route('sidangPwkExcel.export') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <!-- <a href="{{ route('seminarTmbPdf.export') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-file-pdf-o"></i> Export PDF</a> -->
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

        table = $('.table-rekap-seminar').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('rekap-sidangPwk.data') }}",
                data: function(d) {
                    d.tahun_ajaran_id = $('#tahunajaran').val();
                    d.semester_id = $('#semester').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    'searchable': false,
                    'sortable': false
                },
                {
                    data: 'mahasiswa.nik'
                },
                {
                    data: 'mahasiswa.nama'
                },
                {
                    data: 'tahun_ajaran.tahun_ajaran'
                },
                {
                    data: 'semester.semester'
                },
                {
                    data: 'tanggal_pengajuan'
                },
                {
                    data: 'aksi'
                }
            ]
        })

        $('#tahunajaran').change(function() {
            table.ajax.reload();
            // table.column(3).search($(this).val()).draw();
        })

        $('#semester').change(function() {
            table.ajax.reload();
            // table.column(4).search($(this).val()).draw();
        })
    })
</script>
@endpush