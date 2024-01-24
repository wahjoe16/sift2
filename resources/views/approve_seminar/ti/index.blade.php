@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Approval Seminar Tugas Akhir</h3>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('seminarTiDownload.index') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-download"></i> Unduh Dokumen</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-approve-seminar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="15%"><i class="fa fa-cogs"></i> Approve</th>
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
                url: "{{ route('view-seminarTi.data') }}"
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
                    data: 'approve'
                }
            ]
        })
    })
</script>
@endpush