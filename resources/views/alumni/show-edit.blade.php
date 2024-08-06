@extends('layouts.dashboard')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box">
                <div class="box-body box-profile">
                    @if(!empty(auth()->user()->foto))
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/user/foto/' . auth()->user()->foto ?? '') }}" alt="">
                    @else
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('user/foto/user.png') }}" alt="" style="width: 300px important;">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Profile</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('alumni.show-edit') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nik" class="col-sm-2 control-label">NIK / NPM</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nik" id="nik" placeholder="Email" value="{{ auth()->user()->nik }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="{{ auth()->user()->nama }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="program_studi" class="col-sm-2 control-label">Program Studi</label>

                                <div class="col-sm-10">
                                    <select name="program_studi" id="program_studi" class="form-control text-dark">
                                        <option value="">Select</option>
                                        @foreach ([
                                        "Teknik Pertambangan"=>"Teknik Pertambangan",
                                        "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                                        "Teknik Industri"=>"Teknik Industri",
                                        "Program Profesi Insinyur"=>"Program Profesi Insinyur",
                                        "Magister Perencanaan Wilayah dan Kota"=>"Magister Perencanaan Wilayah dan Kota"
                                        ] as $programStudi => $prodiLabel)
                                        <option value="{{ $programStudi }}" {{ old("program_studi", auth()->user()->program_studi)==$programStudi ? "selected" : "" }}>{{ $prodiLabel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Tahun Lulus</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tahun_lulus" id="tahun_lulus" placeholder="Tahun Lulus" value="{{ $alumni->tahun_lulus }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ auth()->user()->email }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="col-sm-2 control-label">No Handphone</label>

                                <div class="col-sm-10">
                                    <input type="telepon" class="form-control" name="telepon" id="telepon" placeholder="telepon" value="{{ auth()->user()->telepon }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Pekerjaan Sekarang</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pekerjaan_sekarang" id="pekerjaan_sekarang" placeholder="Tahun Lulus" value="{{ $alumni->pekerjaan_sekarang }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Perusahaan Sekarang</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="perusahaan_sekarang" id="perusahaan_sekarang" placeholder="Tahun Lulus" value="{{ $alumni->perusahaan_sekarang }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Alamat Perusahaan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Perusahaan" value="{{ $alumni->alamat }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="col-sm-2 control-label">Foto</label>

                                <div class="col-sm-10">
                                    <input type="file" name="foto" class="dropify" id="foto">
                                    @if(!empty(auth()->user()->foto))
                                    <a target="_blank" href="{{ asset('/user/foto/' . auth()->user()->foto ?? '') }}">Lihat Foto</a>
                                    <input type="hidden" name="current_user_foto" id="current_user_foto" value="{{ auth()->user()->foto }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-success">Simpan</button>
                            <a href="{{ url('/dashboard') }}" class="btn btn-flat btn-danger">Batal</a>
                        </div>
                        <!-- /.box-footer -->
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