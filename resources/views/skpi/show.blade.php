@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Rekap SKKFT <strong>{{ $data->user_skkft->nama }}</h3>
    </div>
</div>
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <button disabled onclick="deleteSelected('{{ route('skpi.delete-selected') }}')" class="btn btn-danger btn-sm btn-hapus-pilih"><i class="fas fa-trash"></i> Hapus yang dipilih</button>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" id="form-skpi">@csrf
                    <table class="table table-striped table-bordered table-skkft">
                        <thead>
                            <th>Nama Kegiatan</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>Link Bukti Fisik</th>
                            <th><input type="checkbox" name="select_all" id="select_all" class="select_all"></th>
                            <th width="12%"><i class="fas fa-cogs"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <form action="{{ route('skpi.verify', $data->id) }}" method="POST">@csrf
                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-check"></i> Terbitkan SKPI</button>
                </form>
            </div>
        </div>
    </div>
</div>
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
                    data: 'nama_kegiatan'
                },
                {
                    data: 'categories_skkft.category_name'
                },
                {
                    data: 'subcategories_skkft.subcategory_name'
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