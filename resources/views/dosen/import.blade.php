@extends('layouts.master')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Import data Dosen</h3>
                </div>
                <div class="box-body">
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
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('dosen.index') }}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                            </div>

                        </div>
                    </form>
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