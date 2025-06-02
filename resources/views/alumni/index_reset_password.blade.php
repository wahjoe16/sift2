@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Permintaan Reset Password Alumni</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Reset Password</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-alumni">
                    <thead>
                        <tr>
                            {{-- <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th> --}}
                            <th width="7%">No</th>
                            <th>Email Alumni</th>
                            <th>Token Untuk Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d => $value)
                            <tr>
                                <td>{{ $d+1 }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->token }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
