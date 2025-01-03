@extends('layouts.master')

@section('content')

<section class="content-header">
    <h3>Permintaan Reset Password Alumni</h3>
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