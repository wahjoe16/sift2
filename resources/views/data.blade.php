@extends('layouts.master')

@section('content')

<section class="content-header">
    <h1>
        Data Master Sistem Informasi Fakultas Teknik</b>
    </h1>
    <ol class="breadcrumb">
        @section('breadcrumb')
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        @show
    </ol>
</section>

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-7 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Mahasiswa</h4>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-mahasiswa">

                </table>
            </div>
        </div>
    </div>
</section>

@endsection