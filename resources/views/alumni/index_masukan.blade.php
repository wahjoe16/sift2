@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Saran & Masukan Alumni Fakultas Teknik</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Saran & Masukan</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-alumni">
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
            </div>
        </div>
    </div>
</div>

@endsection
