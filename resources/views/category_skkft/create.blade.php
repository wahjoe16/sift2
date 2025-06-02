@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">{{ $title }}</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('category-skkft.store') }}" method="post">@csrf
                    <div class="form-group">
                        <label for="category_name">Kategori SKKFT</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <input type="number" name="bobot" id="bobot" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('category-skkft.index') }}" class="btn btn-sm btn-light"><i class="fas fa-arrow-circle-left"></i> Batal</a>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
