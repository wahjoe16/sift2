@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Posisi Pekerjaan Alumni</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    {{ $title }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('posisi-pekerjaan.store') }}" method="post">@csrf
                    <div class="form-group">
                        <label for="nama_posisi">Nama Posisi</label>
                        <input type="text" name="nama_posisi" id="nama_posisi" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('posisi-pekerjaan.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-circle-left"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection