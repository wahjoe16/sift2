@extends('layouts.portal.master')

@push('top_css')

    <style>

        .element-foto-profile {
            display: inline-flex;
            position: relative;
            bottom: 80px;
            right: 10px;
        }
        
        i.bi-pencil {
            margin: 10px;
            cursor: pointer;
            font-size: 15px;
        }

        i:hover {
            opacity: 0.6;
        }

        .element-foto-banner {
            display: inline-flex;
            position: relative;
            bottom: 60px;
            right: 15px;
        }

        .element-foto-banner > i.bi-pencil {
            margin: auto;
            cursor: pointer;
            font-size: 15px;
            background-color: #fff;
            color: #565656;
            width: 35px;
            height: 35px;
            align-content: center;
            border-radius: 50%;
            opacity: 0.6;
            content: "\f4cb";
            padding-left: 8px;
        }

        .element-foto-banner > i.bi-pencil:hover {
            opacity: 1;
        }

        i:hover {
            opacity: 0.6;
        }
        
    </style>
    
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @include('frontend.banner-profile')
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3">
            @include('frontend.side-menu-profile')
        </div>
        <div class="col-lg-9">
            @if ($slug == 'profil')
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="true">Informasi Alumni</button>
                        <button class="nav-link" id="nav-pendidikan-tab" data-bs-toggle="tab" data-bs-target="#nav-pendidikan" type="button" role="tab" aria-controls="nav-pendidikan" aria-selected="false">Riwayat Pendidikan</button>
                        <button class="nav-link" id="nav-jobs-tab" data-bs-toggle="tab" data-bs-target="#nav-jobs" type="button" role="tab" aria-controls="nav-jobs" aria-selected="false">Pengalaman Bekerja</button>
                        <button class="nav-link" id="nav-kompetensi-tab" data-bs-toggle="tab" data-bs-target="#nav-kompetensi" type="button" role="tab" aria-controls="nav-kompetensi" aria-selected="false">Kompetensi</button>
                        <button class="nav-link" id="nav-skill-tab" data-bs-toggle="tab" data-bs-target="#nav-skill" type="button" role="tab" aria-controls="nav-skill" aria-selected="false">Keahlian</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                        <div class="mt-5">
                            <h5 class="mb-4"><i class="bi bi-info-circle icon-menu-profile" style="color: #3a9e66;"></i> Update Infomasi Alumni</h5>
                            <form action="{{ route('frontend.profile-update', 'personal') }}" method="post">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Misal: Muhammad Farhan" value="{{ Auth::guard('alumni')->user()->nama }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Misal: farhan.123@gmail.com" value="{{ Auth::guard('alumni')->user()->email }}">
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" rows="3">
                                            {{ $dataAlumni->alamat }}
                                        </textarea>
                                        <input class="form-check-input" name="allow_alamat" type="checkbox" value="1" @if($dataAlumni->allow_view_alamat != '') checked @endif id="allow_alamat">
                                        <label class="form-check-label" for="allow_alamat" style="color: #1a75d6; font-size: 13px;">
                                            Ijinkan Alamat di publish
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="no_hp" class="form-label">Telepon / HP</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Misal: 085733456345" value="{{ $dataAlumni->no_hp }}">

                                        <input class="form-check-input" name="allow_telepon" type="checkbox" value="1" @if($dataAlumni->allow_view_no_hp != '') checked @endif id="allow_telepon">
                                        <label class="form-check-label" for="allow_telepon" style="color: #1a75d6; font-size: 13px;">
                                            Ijinkan Telepon / No HP di publish
                                        </label>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <label for="pekerjaan_sekarang" class="form-label">Pekerjaan Sekarang</label>
                                        <input type="text" name="pekerjaan_sekarang" class="form-control" placeholder="Misal: Manajer Keuangan" value="{{ $dataAlumni->pekerjaan_sekarang }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="perusahaan_sekarang" class="form-label">Nama Perusahaan / Instansi</label>
                                        <input type="text" name="perusahaan_sekarang" class="form-control" placeholder="Misal: PT. Telekomunikasi Indonesia" value="{{ $dataAlumni->perusahaan_sekarang }}">
                                    </div>
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-pendidikan" role="tabpanel" aria-labelledby="nav-pendidikan-tab">
                        <div class="mt-5">
                            <h5><i class="bi bi-mortarboard  icon-menu-profile" style="color: #0317fc"></i> Riwayat Pendidikan</h5>
                            <button onclick="createPendidikan('{{ route('frontend.profile-update', 'lulusan') }}')" class="btn btn-success btn-sm mb-2 mt-2">TAMBAH DATA</button>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($profilLulusan as $pl)
                                                    <li class="list-group-item" style="margin-left: 5px;">
                                                        <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-bank"></i>&nbsp;&nbsp;{{ $pl['perguruan_tinggi'] }}<span>&nbsp;&nbsp;<button onclick="editPendidikan('{{ route('frontend.profile-edit', $pl['id']) }}')" class="btn btn-xs ms-auto"><i class="bi bi-pencil"></i></button></span></p>
                                                        <p class="card-text" style="font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px">{{ $pl['jenjang'] }}, {{ $pl['program_studi'] }}</p>
                                                        <p class="card-text" style="color: grey; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px">{{ $pl['angkatan'] }} - {{ $pl['tahun_lulus'] }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @includeIf('frontend.modal-form.create_pendidikan')
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-jobs" role="tabpanel" aria-labelledby="nav-jobs-tab">
                        <div class="mt-5">
                            <h5><i class="bi bi-suitcase-lg icon-menu-profile" style="color: #fc4e03;"></i> Pengalaman Pekerjaan</h5>
                            <button onclick="createPekerjaan('{{ route('frontend.profile-update', 'jobs') }}')" class="btn btn-success btn-sm mb-2 mt-2">TAMBAH DATA</button>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($jobsAlumni as $ja => $value)
                                                    <li class="list-group-item" style="margin-left: 5px;">
                                                        <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-buildings-fill"></i>&nbsp;&nbsp;{{ $value['posisi'] }}<span>&nbsp;&nbsp;<button onclick="editPekerjaan('{{ route('frontend.profile-edit-pekerjaan', $value['id']) }}')" class="btn btn-xs ms-auto"><i class="bi bi-pencil"></i></button></span></p>
                                                        <p class="card-text" style="font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px;">{{ $value['nama_perusahaan'] }}</p>
                                                        <p class="card-text" style="color: grey; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px;">{{ $value['tahun_masuk_bekerja'] }} - {{ $value['tahun_berhenti_bekerja'] }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @includeIf('frontend.modal-form.create_pekerjaan')
                            
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-kompetensi" role="tabpanel" aria-labelledby="nav-kompetensi-tab">
                        <div class="mt-5">
                            <h5><i class="bi bi-shield-plus icon-menu-profile" style="color: #87036f;"></i> Sertifikasi Kompetensi</h5>
                            <button onclick="createKompetensi('{{ route('frontend.profile-update', 'kompetensi') }}')" class="btn btn-success btn-sm mb-2 mt-2">TAMBAH DATA</button>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($skillAlumni as $sa => $value)
                                                    <li class="list-group-item" style="margin-left: 5px;">
                                                        <p class="card-text mt-3" style="font-size: 18px; font-weight: bold;"><i class="bi bi-card-list"></i>&nbsp;&nbsp;{{ $value['kompetensi'] }}<span>&nbsp;&nbsp;<button onclick="" class="btn btn-xs ms-auto"><i class="bi bi-pencil"></i></button></span></p>
                                                        <p class="card-text" style="color: white; font-size: 15px; font-weight: 300; margin-top: -15px; margin-left: 26px""><a class="btn btn-info btn-sm" href="{{ url('/alumni/sertifikat/', $value['sertifikat_kompetensi']) }}"><i class="bi bi-link-45deg"></i> Lihat Sertifikat</a></p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @includeIf('frontend.modal-form.create_kompetensi')
                            
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-skill" role="tabpanel" aria-labelledby="nav-skill-tab">
                        <div class="mt-5">
                            <h5><i class="bi bi-wrench-adjustable icon-menu-profile" style="color: #04d4c6;"></i> Keahlian</h5>
                            <button onclick="createKeahlian('{{ route('frontend.profile-update', 'keahlian') }}')" class="btn btn-success btn-sm mb-2 mt-2">TAMBAH DATA</button>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($keahlianAlumni as $ka => $value)
                                                    <li class="list-group-item" style="margin-left: 5px;">
                                                        <p class="card-text mt-3" style="font-size: 18px; font-weight: 300;"><i class="bi bi-check-square"></i>&nbsp;&nbsp;{{ $value['keahlian'] }}<span>&nbsp;&nbsp;<button onclick="" class="btn btn-xs ms-auto"><i class="bi bi-pencil"></i></button></span></p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @includeIf('frontend.modal-form.create_keahlian')
                            
                        </div>
                    </div>
                </div>
           
            @elseif ($slug == 'password')

                <h5><i class="bi bi-lock icon-menu-profile" style="color: #e61049;"></i> Ganti Password</h5>
                <hr>
                <p style="color: grey;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
                <hr>
                <form action="{{ route('frontend.profile-update', 'password') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Password Lama</label>
                        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Password lama anda">
                        
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password baru">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi password baru">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success btn-md">Simpan</button>
                    </div>
                </form>

            @endif
        </div>
    </div>

    @includeIf('frontend.modal-form.banner')

    @includeIf('frontend.modal-form.photo-profile')

@endsection

@push('bottom_scripts')

<script>

    $('#pekerjaan-form').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#pekerjaan-form form').attr('action'), $('#pekerjaan-form form').serialize())
                .done((response) => {
                    $('#pekerjaan-form').modal('hide');
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });

    function createPekerjaan(url) {
        $('#pekerjaan-form').modal('show');
        $('#pekerjaan-form .pekerjaan-title').text('Tambah Data Pengalaman Pekerjaan');
        
        $('#pekerjaan-form form')[0].reset();
        $('#pekerjaan-form form').attr('action', url);
        $('#pekerjaan-form [name=_method]').val('post');
    }

    function editPekerjaan(url) {
        $('#pekerjaan-form').modal('show');
        $('#pekerjaan-form .pekerjaan-title').text('Edit Data Pengalaman Pekerjaan'); 
        
        $('#pekerjaan-form form')[0].reset();
        $('#pekerjaan-form form').attr('action', url);
        $('#pekerjaan-form [name=_method]').val('put');

        $.get(url)
            .done((response) => {
                $('#pekerjaan-form #tahun_masuk_bekerja').val(response.tahun_masuk_bekerja);
                $('#pekerjaan-form #tahun_berhenti_bekerja').val(response.tahun_berhenti_bekerja);
                $('#pekerjaan-form #profesi_id').val(response.profesi_id);
                $('#pekerjaan-form #jabatan_id').val(response.jabatan_id);
                $('#pekerjaan-form #bidang_pekerjaan').val(response.bidang_pekerjaan);
                $('#pekerjaan-form #posisi').val(response.posisi);
                $('#pekerjaan-form #nama_perusahaan').val(response.nama_perusahaan);
                $('#pekerjaan-form #lokasi_perusahaan').val(response.lokasi_perusahaan);
            })
            .fail((errors) => {
                alert('Tidak dapat mengambil data');
            });
    }

    $('#pendidikan-form').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#pendidikan-form form').attr('action'), $('#pendidikan-form form').serialize())
                .done((response) => {
                    $('#pendidikan-form').modal('hide');
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });

    function createPendidikan(url) {
        $('#pendidikan-form').modal('show');
        $('#pendidikan-form .pendidikan-title').text('Tambah Data Riwayat Pendidikan');
        
        $('#pendidikan-form form')[0].reset();
        $('#pendidikan-form form').attr('action', url);
        $('#pendidikan-form [name=_method]').val('post');
    }

    function editPendidikan(url) {
        $('#pendidikan-form').modal('show');
        $('#pendidikan-form .pendidikan-title').text('Edit Data Riwayat Pendidikan'); 
        
        $('#pendidikan-form form')[0].reset();
        $('#pendidikan-form form').attr('action', url);
        $('#pendidikan-form [name=_method]').val('put');

        $.get(url)
            .done((response) => {
                $('#pendidikan-form #jenjang').val(response.jenjang);
                $('#pendidikan-form #npm').val(response.npm);
                $('#pendidikan-form #angkatan').val(response.angkatan);
                $('#pendidikan-form #tahun_lulus').val(response.tahun_lulus);
                $('#pendidikan-form #perguruan_tinggi').val(response.perguruan_tinggi);
                $('#pendidikan-form #program_studi').val(response.program_studi);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    $('#kompetensi-form').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#kompetensi-form form').attr('action'), $('#kompetensi-form form').serialize())
                .done((response) => {
                    $('#kompetensi-form').modal('hide');
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });

    function createKompetensi(url) {
        $('#kompetensi-form').modal('show');
        $('#kompetensi-form .kompetensi-title').text('Tambah Data Kompetensi');
        
        $('#kompetensi-form form')[0].reset();
        $('#kompetensi-form form').attr('action', url);
        $('#kompetensi-form [name=_method]').val('post');
    }

    $('#keahlian-form').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#keahlian-form form').attr('action'), $('#keahlian-form form').serialize())
                .done((response) => {
                    $('#keahlian-form').modal('hide');
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });

    function createKeahlian(url) {
        $('#keahlian-form').modal('show');
        $('#keahlian-form .keahlian-title').text('Tambah Data Keahlian');
        
        $('#keahlian-form form')[0].reset();
        $('#keahlian-form form').attr('action', url);
        $('#keahlian-form [name=_method]').val('post');
    }
    
    $('#photo-form').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#photo-form form').attr('action'), $('#photo-form form').serialize())
                .done((response) => {
                    $('#photo-form').modal('hide');
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });

    function photoForm(url) {
        $('#photo-form').modal('show');
        $('#photo-form .photo-profile-title').text('Update Foto Profil');
        
        $('#photo-form form')[0].reset();
        $('#photo-form form').attr('action', url);
        $('#photo-form [name=_method]').val('post');
    }

    $('#banner-form').validator().on('submit', function(e) {
        if (!e.preventDefault()) {
            $.post($('#banner-form form').attr('action'), $('#banner-form form').serialize())
                .done((response) => {
                    $('#banner-form').modal('hide');
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });

    function bannerForm(url) {
        $('#banner-form').modal('show');
        $('#banner-form .banner-profile-title').text('Update Gambar Banner');

        $('#banner-form form')[0].reset();
        $('#banner-form form').attr('action', url);
        $('#banner-form [name=_method]').val('post');
    }

</script>
    
<script>

    $(document).ready(function(){       

        // $("i").click(function () {
        //     $("input[type='file']").trigger('click');
        // });

        // $('input[type="file"]').on('change', function() {
        //     var val = $(this).val();
        //     $(this).siblings('span').text(val);
        // })

        $('#profesi_id').on('change', function() {
            var jabatan = $(this).val();
            if (jabatan) {
                $.ajax({
                    url: '/alumnift/jabatan/' + jabatan,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#jabatan_id').empty();
                        $.each(data, function(key, value) {
                            $('#jabatan_id').append('<option value="' + key + '">' + value + '</option>');
                        })
                    }
                })
            } else {
                $('#jabatan_id').empty();
            }
        })
    })

</script>


<script>
    /*  ==========================================
    SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult1').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $('#upload').on('change', function(){
            readURL(input);
        })
    })

    $(function() {
        $('#upload1').on('change', function(){
            readURL(input);
        })
    })

    /*  ==========================================
    SHOW UPLOADED IMAGE NAME 
    * ==========================================*/
    var input = document.getElementById( 'upload' );
    var infoArea = document.getElementById( 'upload-label' );

    input.addEventListener( 'change', showFileName );
    function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>
    
@endpush