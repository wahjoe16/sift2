@if(Session::has('error_message'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Error!</h4>
    {{ Session::get('error_message') }}
</div>
@endif

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
    {{ Session::get('success_message') }}
</div>
@endif

@if (Session::has('success_regist'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><i class="bi bi-check-lg"></i>&nbsp;&nbsp;&nbsp;Selamat!</strong> {{ Session::get('success_regist') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('success_reset'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><i class="bi bi-check-lg"></i>&nbsp;&nbsp;&nbsp;Berhasil!</strong> {{ Session::get('success_reset') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif

@if (session()->has('failures'))
<table class="table table-danger">
    <tr>
        <th>Baris</th>
        <th>Atribut</th>
        <th>Pesan Eror</th>
        <th>Value</th>
    </tr>
    @foreach (session()->get('failures') as $validasi)
    <tr>
        <td>{{ $validasi->row() }}</td>
        <td>{{ $validasi->attribute() }}</td>
        <td>
            <ul>
                @foreach ($validasi->errors() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </td>
        <td>{{ $validasi->values()[$validasi->attribute()] }}</td>
    </tr>
    @endforeach
</table>
@endif