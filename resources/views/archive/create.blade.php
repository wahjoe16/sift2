@extends('layouts.dashboard')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/select2/dist/css/select2.min.css') }}">

@push('css_page')
<style>
    ul {
        list-style: none;
    }
</style>
@endpush

@section('content')

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3>Arsip Fakultas Teknik</h3>
    </div>
</div>

@include('layouts.alert')

<form action="{{ route('ft-arsip.store') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Arsip</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="section_id">Nama Arsip</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="section_id">Bidang Arsip</label>
                        <select name="section_id" id="section_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($section as $s)
                            <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_archive_id">Kategori Arsip</label>
                        <select name="category_archive_id" id="category_archive_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($category as $c)
                            <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_archive_id">Subkategori Arsip</label>
                        <select name="subcategory_archive_id" id="subcategory_archive_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($subcategory as $s)
                            <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Akademik</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($ta as $t)
                            <option value="{{ $t['id'] }}">{{ $t['tahun_ajaran'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control select2" required>
                            <option value="">Pilih</option>
                            @foreach($smt as $s)
                            <option value="{{ $s['id'] }}">{{ $s['semester'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>File Arsip</h5>
                </div>
                <div class="card-body">
                    <input type="file" name="file" class="dropify" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Dosen</h5>
                </div>
                <div class="card-body">
                    <input type="checkbox" name="select_all" id="select_all"> Pilih Semua
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-tambang-tab-nobd" data-bs-toggle="pill" href="#v-pills-tambang-nobd" role="tab" aria-controls="v-pills-tambang-nobd" aria-selected="true">Teknik Pertambangan</a>
                                <a class="nav-link" id="v-pills-industri-tab-nobd" data-bs-toggle="pill" href="#v-pills-industri-nobd" role="tab" aria-controls="v-pills-industri-nobd" aria-selected="false">Teknik Industri</a>
                                <a class="nav-link" id="v-pills-pwk-tab-nobd" data-bs-toggle="pill" href="#v-pills-pwk-nobd" role="tab" aria-controls="v-pills-pwk-nobd" aria-selected="false">Perencanaan Wilayah dan Kota</a>
                                <a class="nav-link" id="v-pills-mpwk-tab-nobd" data-bs-toggle="pill" href="#v-pills-mpwk-nobd" role="tab" aria-controls="v-pills-mpwk-nobd" aria-selected="false">Magister Perencanaan Wilayah dan Kota</a>
                                <a class="nav-link" id="v-pills-insinyur-tab-nobd" data-bs-toggle="pill" href="#v-pills-insinyur-nobd" role="tab" aria-controls="v-pills-insinyur-nobd" aria-selected="false">Program Profesi Insinyur</a>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="tab-content" id="v-pills-without-border-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-tambang-nobd" role="tabpanel" aria-labelledby="v-pills-tambang-tab-nobd">
                                    <input type="checkbox" name="select_tmb" id="select_tmb"> Pilih Semua Dosen Teknik Pertambangan
                                    <ul style="list-style: none;">
                                        @foreach ($dosenTmb as $tmb)
                                        <li>
                                            <input type="checkbox" name="dosen_id[]" id="select_tmb" value="{{ $tmb->id }}"> {{ $tmb->nama }} <br>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="v-pills-industri-nobd" role="tabpanel" aria-labelledby="v-pills-industri-tab-nobd">
                                    <input type="checkbox" name="select_ti" id="select_ti"> Pilih Semua Dosen Teknik Industri
                                    <ul style="list-style: none;">
                                        @foreach ($dosenTi as $ti)
                                        <li>
                                            <input type="checkbox" name="dosen_id[]" id="select_ti" value="{{ $ti->id }}"> {{ $ti->nama }} <br>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="v-pills-pwk-nobd" role="tabpanel" aria-labelledby="v-pills-pwk-tab-nobd">
                                    <input type="checkbox" name="select_pwk" id="select_pwk"> Pilih Dosen PWK
                                    <ul style="list-style: none;">
                                        @foreach ($dosenPwk as $pwk)
                                        <li>
                                            <input type="checkbox" name="dosen_id[]" id="select_pwk" value="{{ $pwk->id }}"> {{ $pwk->nama }} <br>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="v-pills-mpwk-nobd" role="tabpanel" aria-labelledby="v-pills-mpwk-tab-nobd">
                                    <input type="checkbox" name="select_mpwk" id="select_mpwk"> Pilih Dosen MPWK
                                    <ul style="list-style: none;">
                                        @foreach ($dosenMpwk as $mpwk)
                                        <li>
                                            <input type="checkbox" name="dosen_id[]" id="select_mpwk" value="{{ $mpwk->id }}"> {{ $mpwk->nama }} <br>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="v-pills-insinyur-nobd" role="tabpanel" aria-labelledby="v-pills-insinyur-tab-nobd">
                                    <input type="checkbox" name="select_psppi" id="select_psppi"> Pilih Dosen PSPPI
                                    <ul style="list-style: none;">
                                        @foreach ($dosenPsppi as $psppi)
                                        <li>
                                            <input type="checkbox" name="dosen_id[]" id="select_psppi" value="{{ $psppi->id }}"> {{ $psppi->nama }} <br>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('ft-arsip.index') }}" class="btn btn-sm btn-light"><i class="fas fa-arrow-circle-left"></i> Batal</a>
        </div>
    </div>
</form>

@endsection

@push('scripts_page')

<!-- Select2 -->
<script src="{{ asset('kai/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
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