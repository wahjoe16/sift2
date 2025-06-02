@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@push('css_page')
<style>
    div.dataTables_wrapper {
        width: 980px;
        margin: 0 auto;
    }
</style>
@endpush

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Download Dokumen Sidang Pembahasan</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row my-3">
            <div class="col-md-6">
                <label for="tahunajaran">Filter Tahun Akademik</label>
                <select name="tahunajaran" id="tahunajaran" class="form-control select2">
                    <option value="">Pilih</option>
                    @foreach ($ta as $t)
                    <option value="{{ $t->id }}">{{ $t->tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="semester">Filter Semester</label>
                <select name="semester" id="semester" class="form-control select2">
                    <option value="">Pilih</option>
                    @foreach ($smt as $s)
                    <option value="{{ $s->id }}">{{ $s->semester }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered table-download-seminar display nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat1"></th> -->
                            <th>Lembar bimbingan skripsi</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat2"></th> -->
                            <th>Sertifikat pesantren mahasiswa baru</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat3"></th> -->
                            <th>Sertifikat pesantren calon sarjana</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat4"></th> -->
                            <th>Transkrip nilai</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat5"></th> -->
                            <th>Sertifikat TOEFL</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat6"></th> -->
                            <th>Bukti bebas pinjaman perpustakaan</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat7"></th> -->
                            <th>Sertifikat SKKFT</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat8"></th> -->
                            <th>Bukti KRS</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat9"></th> -->
                            <th>Bukti pembayaran DPP Mk. Skripsi</th>
                            <!-- <th width="5%"><input type="checkbox" name="select_all_syarat" class="select_all_syarat10"></th> -->
                            <th>Bukti pembayaran sidang pembahasan</th>
                        </tr>
                    </thead>
                </table>
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

        table = $('.table-download-seminar').DataTable({
            processing: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('seminarPwkDownload.data') }}",
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
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'tahun_ajaran'
                },
                {
                    data: 'semester'
                },
                {
                    data: 'status'
                },

                {
                    data: 'syarat_1'
                },

                {
                    data: 'syarat_2'
                },

                {
                    data: 'syarat_3'
                },

                {
                    data: 'syarat_4'
                },

                {
                    data: 'syarat_5'
                },

                {
                    data: 'syarat_6'
                },

                {
                    data: 'syarat_7'
                },

                {
                    data: 'syarat_8'
                },

                {
                    data: 'syarat_9'
                },
                {
                    data: 'syarat_10'
                },
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

        // looping select checkboxes document
        // for (let nomor = 1; nomor <= 10; nomor++) {
        //     $('.select_all_syarat' + nomor).on('click', function() {
        //         console.log($(this).prop('checked'));
        //         $('.syarat' + nomor).prop('checked', $(this).prop('checked'));
        //     })

        //     $('.syarat' + nomor).on('change', function() {
        //         if (false == $(this).prop('checked')) {
        //             $('.select_all_syarat' + nomor).prop('checked', false);
        //         }
        //     })
        // }

    })
</script>
@endpush