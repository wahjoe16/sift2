@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Data SKPI</h3>
                </div>
                <div class="box-body table-responsive">
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
                    </form>
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
</script>
@endpush