@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Data SKPI</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Data Pengajuan SKPI</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Database SKPI</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <table class="table table-striped table-bordered table-print_skpi">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Program Studi</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <table class="table table-striped table-bordered table-database_skpi">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Program Studi</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    let table, table2;

    $(function(){
        table = $('.table-print_skpi').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("skpi.data") }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'user_skpi.nama' },
                { data: 'user_skpi.nik' },
                { data: 'user_skpi.program_studi' },
                { data: 'tanggal'},
                { data: 'aksi', sortable: false},
            ]
        });
    })

    $(function(){
        table2 = $('.table-database_skpi').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("skpi.data-accept") }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'user_skpi.nama' },
                { data: 'user_skpi.nik' },
                { data: 'user_skpi.program_studi' },
                { data: 'tanggal'},
                { data: 'aksi', sortable: false},
            ]
        });
    })
</script>
@endpush