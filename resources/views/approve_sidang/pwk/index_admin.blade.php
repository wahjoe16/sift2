@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Sidang Terbuka</h3>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('sidangPwkDownload.index') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-download"></i> Unduh Dokumen</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-approve-sidang">
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

@endsection

@push('scripts_page')
<script>
    let table;

    $(function() {
        table = $('.table-approve-sidang').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('adminTerbukaPwk.data') }}"
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