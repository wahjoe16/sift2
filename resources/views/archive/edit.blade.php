@extends('layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css') }}">

@push('css_page')
<style>
    ul {
        list-style: none;
    }
</style>
@endpush

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="text-muted">
                        {{ $title }}
                    </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('ft-arsip.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="section_id">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="section_id">Sesi Arsip</label>
                            <div class="col-sm-6">
                                <select name="section_id" id="section_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($section as $s)
                                    <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['section_id'])) selected @endif>{{ $s['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="category_archive_id">Kategori Arsip</label>
                            <div class="col-sm-6">
                                <select name="category_archive_id" id="category_archive_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c['id'] }}" @if(!empty($c['id']==$data['category_archive_id'])) selected @endif>{{ $c['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="subcategory_archive_id">Subkategori Arsip</label>
                            <div class="col-sm-6">
                                <select name="subcategory_archive_id" id="subcategory_archive_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($subcategory as $s)
                                    <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['subcategory_archive_id'])) selected @endif>{{ $s['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="tahun_ajaran_id">Tahun Akademik</label>
                            <div class="col-sm-6">
                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($ta as $t)
                                    <option value="{{ $t['id'] }}" @if(!empty($t['id']==$data['tahun_ajaran_id'])) selected @endif>{{ $t['tahun_ajaran'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="semester_id">Semester</label>
                            <div class="col-sm-6">
                                <select name="semester_id" id="semester_id" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    @foreach($smt as $s)
                                    <option value="{{ $s['id'] }}" @if(!empty($s['id']==$data['semester_id'])) selected @endif>{{ $s['semester'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="select_all">Pilih Dosen</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="select_all" id="select_all"> Pilih Semua
                                <hr>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="checkbox" name="select_tmb" id="select_tmb"> Pilih Dosen Tambang
                                            <ul>
                                                <h5><b>Teknik Pertambangan</b></h5>
                                                @foreach ($dosenTmb as $tmb)
                                                <li>
                                                    <input type="checkbox" name="dosen_id[]" id="select_tmb" value="{{ $tmb->id }}"> {{ $tmb->nama }} <br>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="checkbox" name="select_ti" id="select_ti"> Pilih Dosen TI
                                            <ul>
                                                <h5><b>Teknik Industri</b></h5>
                                                @foreach ($dosenTi as $ti)
                                                <li>
                                                    <input type="checkbox" name="dosen_id[]" id="select_ti" value="{{ $ti->id }}"> {{ $ti->nama }} <br>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="checkbox" name="select_pwk" id="select_pwk"> Pilih Dosen PWK
                                            <ul>
                                                <h5><b>Perencanaan Wilayah dan Kota</b></h5>
                                                @foreach ($dosenPwk as $pwk)
                                                <li>
                                                    <input type="checkbox" name="dosen_id[]" id="select_pwk" value="{{ $pwk->id }}"> {{ $pwk->nama }} <br>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="select_psppi" id="select_psppi"> Pilih Dosen PSPPI
                                            <ul>
                                                <h5><b>Program Profesi Insinyur</b></h5>
                                                @foreach ($dosenPsppi as $psppi)
                                                <li>
                                                    <input type="checkbox" name="dosen_id[]" id="select_psppi" value="{{ $psppi->id }}"> {{ $psppi->nama }} <br>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="select_mpwk" id="select_mpwk"> Pilih Dosen MPWK
                                            <ul>
                                                <h5><b>Magister Perencanaan Wilayah dan Kota</b></h5>
                                                @foreach ($dosenMpwk as $mpwk)
                                                <li>
                                                    <input type="checkbox" name="dosen_id[]" id="select_mpwk" value="{{ $mpwk->id }}"> {{ $mpwk->nama }} <br>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty($data->file))
                        <div class="form-group row">
                            <div class="col-lg-2 col-lg-offset-1"></div>
                            <div class="col-md-6">
                                @php
                                $path = asset("/file/archives/$data->file");
                                @endphp
                                <a href="{{ asset('/file/archives/')."/".$data->file }}">
                                    <p>{{ $data->file }}</p>
                                </a>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-lg-2 col-lg-offset-1 control-label" for="description">Upload File Arsip</label>
                            <div class="col-sm-6">
                                <input type="file" name="file" class="dropify">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <a href="{{ route('ft-arsip.index') }}" class="btn btn-sm btn-light"><i class="fa fa-arrow-circle-left"></i> Batal</a>
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

<!-- Select2 -->
<script src="{{ asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        // dropify
        $('.dropify').dropify();

        // select all Checkbox
        $('[name = select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        })

        // multi level checkbox in JS
        $('input[type="checkbox"]').change(function(e) {

            var checked = $(this).prop("checked"),
                container = $(this).parent(),
                siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked
            });

            function checkSiblings(el) {

                var parent = el.parent().parent(),
                    all = true;

                el.siblings().each(function() {
                    let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
                    return returnValue;
                });

                if (all && checked) {

                    parent.children('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked
                    });

                    checkSiblings(parent);

                } else if (all && !checked) {

                    parent.children('input[type="checkbox"]').prop("checked", checked);
                    parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                    checkSiblings(parent);

                } else {

                    el.parents("li").children('input[type="checkbox"]').prop({
                        indeterminate: true,
                        checked: false
                    });

                }

            }

            checkSiblings(container);
        });
    })
</script>

<!-- Dependent Dropdown -->
<script>
    jQuery(document).ready(function() {
        jQuery('select[name="section_id"]').on('change', function() {
            var category = jQuery(this).val();
            if (category) {
                jQuery.ajax({
                    url: '/archives/dropdownlist/category-archive/' + category,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="category_archive_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="category_archive_id"]').append('<option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="category_archive_id"]').empty();
            }
        })

        jQuery('select[name="category_archive_id"]').on('change', function() {
            var subcategory = jQuery(this).val();
            if (subcategory) {
                jQuery.ajax({
                    url: '/archives/dropdownlist/sub-category-archive/' + subcategory,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="subcategory_archive_id"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="subcategory_archive_id"]').append('<option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('select[name="subcategory_archive_id"]').empty();
            }
        })
    })
</script>
<!-- end Dependent Dropdown -->

@endpush