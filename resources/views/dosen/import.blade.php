@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Import data Dosen</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('dosen.import') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="file" class="col-sm-2 control-label">File Excel</label>

                        <div class="col-sm-10">
                            <input type="file" name="file" class="dropify" id="file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('dosen.index') }}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-footer">
                <h4><a href="{{ asset('') }}">Download file sample untuk import data dosen</a></h4>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')
<script>
    $('.dropify').dropify();
</script>
@endpush