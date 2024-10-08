@extends('layouts.master')

@section('content')

<section class="content">
    <h3>Rekap SKKFT <strong>{{ $data->user_skkft->nama }}</strong></h3>
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <button disabled onclick="deleteSelected('{{ route('skpi.delete-selected') }}')" class="btn btn-danger btn-sm btn-flat btn-hapus-pilih"><i class="fa fa-trash"></i> Hapus yang dipilih</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="" method="post" id="form-skpi">@csrf
                                <table class="table table-striped table-bordered table-skkft">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Tingkat</th>
                                        <th>Prestasi</th>
                                        <th>Jabatan</th>
                                        <th>Link Bukti Fisik</th>
                                        <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                                        <th width="12%"><i class="fa fa-cogs"></i></th>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-footer with-border">
                    <form action="{{ route('skpi.verify', $data->id) }}" method="POST">@csrf
                        <button type="submit" class="btn btn-info btn-md btn-flat"><i class="fa fa-check"></i> Terbitkan SKPI</button>
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
        table = $('.table-skkft').DataTable({
            processing: true,
            autoWidth: false,
            paging: false,
            ajax: {
                url: '{{ route("kegiatanSkpi.data", $data->id) }}',
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'nama_kegiatan'
                },
                {
                    data: 'categories_skkft.category_name'
                },
                {
                    data: 'subcategories_skkft.subcategory_name'
                },
                {
                    data: 'tingkat_skkft.tingkat',
                    defaultContent: "-",
                },
                {
                    data: 'prestasi_skkft.prestasi',
                    defaultContent: "-",
                },
                {
                    data: 'jabatan_skkft.jabatan',
                    defaultContent: "-",
                },
                {
                    data: 'bukti_fisik'
                },
                {
                    data: 'select_all'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        })
    })
    
    $(document).on('click', '.select_all', function(){
        $(':checkbox').prop('checked', this.checked);

        if ($('.select_item:checked').length > 0) {
            $('.btn-hapus-pilih').removeAttr('disabled');
        } else {
            $('.btn-hapus-pilih').attr('disabled', true);
        }
    })

    $(document).on('click', '.select_item', function(){
        if ($('.select_item').length === $('.select_item:checked').length) {
            $('.select_all').prop('checked', true);
        }else {
            $('.select_all').prop('checked', false);
        }

        if ($('.select_item:checked').length > 0) {
            $('.btn-hapus-pilih').removeAttr('disabled');
        } else {
            $('.btn-hapus-pilih').attr('disabled', true);
        }
    })

    function deleteSelected(url) {
        if ($('input:checked').length > 0) {
            if (confirm('Yakin akan menghapus data terpilih?')) {
                $.post(url, $('#form-skpi').serialize())
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        } else {
            alert('Pilih data yang akan dihapus');
            return;
        }
    }

</script>
@endpush