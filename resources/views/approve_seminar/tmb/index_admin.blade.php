@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3>Kolokium Skripsi</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-approve-seminar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@includeIf('mahasiswa.form')

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {
        table = $('.table-approve-seminar').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('adminKolokiumTmb.data') }}"
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
                    data: 'tanggal_pengajuan'
                },
                {
                    data: 'status'
                },
                {
                    data: 'approve'
                }
            ]
        })
    })
</script>
@endpush