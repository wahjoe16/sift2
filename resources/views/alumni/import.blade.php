@extends('layouts.dashboard')

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="fw-bold">Alumni Fakultas Teknik</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Import data mahasiswa</h5><br>
                <a href="{{ asset('/alumni/sample-file-alumni.xlsx') }}">Download sample file</a>
            </div>
            <div class="card-body">
                <form action="{{ route('alumni.import') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="file">File Excel</label>
                        <input type="file" name="file" class="dropify" id="file">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('alumni.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-circle-left"></i> Batal</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget">
                <div class="box-header with-border">
                    
                </div>
                <div class="box-body">
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    $('.dropify').dropify();
</script>
@endpush