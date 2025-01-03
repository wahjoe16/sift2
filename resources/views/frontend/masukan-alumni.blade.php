@extends('layouts.portal.master')

@section('content')

<div class="row">
    <div class="col-lg-8 ms-auto me-auto mt-3">
        <h1 class="text-center">Saran & Masukan Dari Alumni FT</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 ms-auto me-auto mt-3">
        <button onclick="createMasukan('{{ route('frontend.create-masukan-alumni') }}')" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;TAMBAH DATA</button>
        @foreach ($data as $d)
            <div class="card mt-2">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" style="margin-left: 5px;">
                            <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-card-text"></i>&nbsp;&nbsp;Masukan Fakultas</p>
                            
                            <?php $p1 = explode(PHP_EOL, $d->masukan_fakultas); ?>
                            @foreach($p1 as $p1s)
                                <p class="card-text" style="font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px"><i class="bi bi-chevron-right"></i>&nbsp;&nbsp;{{ $p1s }}</p>
                            @endforeach
                            
                            <p class="card-text" style="color: grey; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px"><i class="bi bi-calendar-date"></i>&nbsp;&nbsp;{{ tanggal_indonesia($d->created_at, false) }}</p>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" style="margin-left: 5px;">
                            <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-card-text"></i>&nbsp;&nbsp;Masukan Aplikasi</p>
                            
                            <?php $p2 = explode(PHP_EOL, $d->masukan_aplikasi); ?>
                            @foreach($p2 as $p2s)
                                <p class="card-text" style="font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px"><i class="bi bi-chevron-right"></i>&nbsp;&nbsp;{{ $p2s }}</p>
                            @endforeach
                            
                            <p class="card-text" style="color: grey; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px"><i class="bi bi-calendar-date"></i>&nbsp;&nbsp;{{ tanggal_indonesia($d->created_at, false) }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>

@includeIf('frontend.modal-form.create_masukan')

@endsection

@push('bottom_scripts')
    <script>
        function createMasukan(url){
            $('#masukan-form').attr('action', url);
            $('#masukan-form').modal('show');
            $('#masukan-form .masukan-title').text('Saran & Masukan');
            $('#masukan-form form')[0].reset();
            $('#masukan-form [name=_method]').val('post');
        }

        $('#masukan-form').validator().on('submit', function(){
            if (!event.preventDefault()) {
                $.post($('#masukan-form form').attr('action'), $('#masukan-form form').serialize())
                .done((response)=> {
                    $('#masukan-form').modal('hide');
                    alert('Data berhasil disimpan');
                })
                .fail((errors)=> {
                    alert('Data gagal disimpan');
                    return;
                });
            }
        })
    </script>
@endpush