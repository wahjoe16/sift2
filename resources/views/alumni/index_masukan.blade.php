@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Saran & Masukan Alumni Fakultas Teknik</h3>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-mahasiswa">@csrf
                        <table class="table table-striped table-bordered table-alumni">
                            <thead>
                                <tr>
                                    {{-- <th width="5%">
                                        <input type="checkbox" name="select_all" id="select_all">
                                    </th> --}}
                                    <th width="7%">No</th>
                                    <th>ID Alumni</th>
                                    <th>Masukan Untuk Fakultas</th>
                                    <th>Masukan Untuk Sistem</th>
                                    <th width="15%"><i class="fa fa-cogs"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d => $value)
                                    <tr>
                                        <td>{{ $d+1 }}</td>
                                        <td>{{ $value->user_id }}</td>
                                        <td>
                                            <?php $p1 = explode(PHP_EOL, $value->masukan_fakultas); ?>
                                            @foreach ($p1 as $p1s)
                                                {{ $p1s }}
                                            @endforeach
                                        </td>
                                        <td>{{ $value->masukan_aplikasi }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- @includeIf('mahasiswa.form') --}}

@endsection

@push('scripts_page')
<script>
    
</script>
@endpush