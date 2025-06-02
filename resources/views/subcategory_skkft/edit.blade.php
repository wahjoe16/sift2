@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Sub Kategori SKKFT</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('subcategory-skkft.update', $subcategory_skkft->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category_id">Kategori SKKFT</label>
                        
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach($category as $c)
                                <option value="{{ $c['id'] }}" @if(!empty($c['id']==$subcategory_skkft['category_id'])) selected @endif>{{ $c['category_name'] }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_name">Subkategori SKKFT</label>
                        
                            <input type="text" name="subcategory_name" id="subcategory_name" value="{{ $subcategory_skkft->subcategory_name }}" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('subcategory-skkft.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection