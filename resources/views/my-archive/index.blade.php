@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <h3>Arsip Saya</h3>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ route('my-archive.create') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" class="form-archive">
                        @csrf
                        <table class="table table-striped table-bordered table-myarchive">
                            <thead>
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Sesi</th>
                                <th>Kategori Arsip</th>
                                <th>Sub Kategori Arsip</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th width="15%"><i class="fa fa-cogs"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
                <div class="box-footer with-border">
                    <div class="btn-group">
                        <button onclick="downloadSelected('{{ route('myarchive.downloadselected') }}')" class="btn btn-primary btn-flat"><i class="fa fa-download"></i> Download Selected</button>
                        <!-- <a href="{{ route('myarchive.downloadselected') }}" class="btn btn-info btn-flat"><i class="fa fa-download"></i> Download as Zip</a> -->
                    </div>
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

        // select all checkbox
        $('[name=select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        })

        table = $('.table-myarchive').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("my-archive.data") }}',
            },
            columns: [{
                    data: 'select_all',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'a_name'
                },
                {
                    data: 's_name'
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
                    data: 'aksi'
                }
            ]
        })
    })

    function downloadSelected(url) {
        if ($('input:checked').length >= 1) {
            if (confirm('Yakin?')) {
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
            alert('Pilih data yang akan didownload');
            return;
        }
    }
</script>
@endpush