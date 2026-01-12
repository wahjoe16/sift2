@extends('layouts.dashboard')

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@section('content')

<form class="form-horizontal" action="{{ route('update.profil') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card card-post card-round">
                <img class="card-img-top" src="{{ asset('/media/unisba.JPG') }}" alt="Card image cap" />
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar avatar-xxl">
                            @if(!empty(auth()->user()->foto))
                            <img class="avatar-img rounded-circle" src="{{ route('profil.foto') }}" alt="">
                            @else
                            <img class="avatar-img rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="">
                            @endif
                        </div>
                        <div class="info-post ms-2">
                            <p class="username">{{ auth()->user()->nama }}</p>
                            <p class="date text-muted">{{ auth()->user()->nik }}</p>
                        </div>
                    </div>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Program Studi</h3>
                    <p class="card-text">{{ auth()->user()->program_studi }}</p>

                    <input type="hidden" name="nama" value="{{ auth()->user()->nama }}">

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Email</h3>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" value="{{ auth()->user()->email }}" required autofocus>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">No. Telepon</h3>
                    <input type="number" name="telepon" id="telepon" class="form-control" placeholder="Your Phone" value="{{ auth()->user()->telepon }}" required autofocus>

                    <div class="separator-solid"></div>
                    <h3 class="card-title">Foto Profil</h3>
                    <input type="file" name="foto" class="dropify" id="foto" data-default-file="{{ route('profil.foto') }}"  required autofocus>
                    <input type="hidden" name="current_user_foto" id="current_user_foto" value="{{ auth()->user()->foto }}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Profile</h5>
                </div>
                <div class="card-body">
                    @if (auth()->user()->level == 1)
                        <h3 class="card-title">Status Super Admin</h3>
                        <select name="superadmin" id="superadmin" class="form-control" disabled>
                            <option value="">Superadmin</option>
                            @foreach ([
                            "0"=>"Tidak",
                            "1"=>"Ya",
                            ] as $superadmin => $superadminLabel )
                            <option value="{{ $superadmin }}" {{ old("superadmin", auth()->user()->status_superadmin)==$superadmin ? "selected" : "" }}>{{ $superadminLabel }}</option>
                            @endforeach
                        </select>
                    @endif

                    @if (auth()->user()->level == 2)
                        <h3 class="card-title">Tipe Dosen</h3>
                        <select name="tipe_dosen" id="tipe_dosen" class="form-control text-dark" required autofocus>
                            <option value="">Select</option>
                            @foreach ([
                            "internal"=>"Internal",
                            "eksternal"=>"Eksternal"
                            ] as $tipeDosen => $tipeDosenLabel)
                            <option value="{{ $tipeDosen }}" {{ old("tipe_dosen", auth()->user()->tipe_dosen)==$tipeDosen ? "selected" : "" }}>{{ $tipeDosenLabel }}</option>
                            @endforeach
                        </select>

                        <div class="separator-solid"></div>
                        <h3 class="card-title">Status Dekanat</h3>
                        <select name="status_dekanat" id="status_dekanat" class="form-control" disabled>
                            <option value="">Select</option>
                            @foreach ([
                            "0"=>"Tidak",
                            "1"=>"Ya",
                            ] as $status_dekanat => $status_dekanatLabel )
                            <option value="{{ $status_dekanat }}" {{ old("status_dekanat", auth()->user()->status_dekanat)==$status_dekanat ? "selected" : "" }}>{{ $status_dekanatLabel }}</option>
                            @endforeach
                        </select>

                        <div class="separator-solid"></div>
                        <h3 class="card-title">Status Koordinator Skripsi</h3>
                        <select name="status_koordinator_skripsi" id="status_koordinator_skripsi" class="form-control" disabled>
                            <option value="">Select</option>
                            @foreach ([
                            "0"=>"Tidak",
                            "1"=>"Ya",
                            ] as $status_koordinator_skripsi => $status_koordinator_skripsiLabel )
                            <option value="{{ $status_koordinator_skripsi }}" {{ old("status_koordinator_skripsi", auth()->user()->status_koordinator_skripsi)==$status_koordinator_skripsi ? "selected" : "" }}>{{ $status_koordinator_skripsiLabel }}</option>
                            @endforeach
                        </select>

                        <div class="separator-solid"></div>
                        <h3 class="card-title">Status Ketua Program Studi</h3>
                        <select name="status_kaprodi" id="status_kaprodi" class="form-control" disabled>
                            <option value="">Select</option>
                            @foreach ([
                            "0"=>"Tidak",
                            "1"=>"Ya",
                            ] as $status_kaprodi => $status_kaprodiLabel )
                            <option value="{{ $status_kaprodi }}" {{ old("status_kaprodi", auth()->user()->status_kaprodi)==$status_kaprodi ? "selected" : "" }}>{{ $status_kaprodiLabel }}</option>
                            @endforeach
                        </select>

                        <div class="separator-solid"></div>
                        <h3 class="card-title">Status Sekertaris Program Studi</h3>
                        <select name="status_sekprodi" id="status_sekprodi" class="form-control" disabled>
                            <option value="">Select</option>
                            @foreach ([
                            "0"=>"Tidak",
                            "1"=>"Ya",
                            ] as $status_sekprodi => $status_sekprodiLabel )
                            <option value="{{ $status_sekprodi }}" {{ old("status_sekprodi", auth()->user()->status_sekprodi)==$status_sekprodi ? "selected" : "" }}>{{ $status_sekprodiLabel }}</option>
                            @endforeach
                        </select>
                    @endif

                    @if (auth()->user()->level == 3)
                        <h3 class="card-title">Program Studi</h3>
                        <select name="program_studi" id="program_studi" class="form-control" required autofocus>
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

                        <div class="separator-solid"></div>
                        <h3 class="card-title">Tempat Lahir</h3>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Place of Birth" value="{{ auth()->user()->tempat_lahir }}" required autofocus>
                        <span class="help-block with-errors"></span>

                        <div class="separator-solid"></div>
                        <h3 class="card-title">Tanggal Lahir</h3>
                        <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Date of Birth" @if($data->tanggal_lahir != '') value="{{ Carbon\Carbon::parse($data->tanggal_lahir)->format('m-d-Y') }}" @endif required autofocus>
                        <span class="help-block with-errors"></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>&nbsp;Simpan</button>
            <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i>&nbsp;Batal</a>
        </div>
    </div>
</form>

@endsection

@push('scripts_page')

<!-- bootstrap datepicker -->
<script src="{{ asset('kai/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $(function(){
        $('.dropify').dropify();

        //Date picker
        $('#tanggal_lahir').datepicker({
            autoclose: true
        })
    })
</script>
@endpush