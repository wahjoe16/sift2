@extends('layouts.portal.master')

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
        @if ($slug == 'personal')
            <h5><i class="bi bi-info-circle icon-menu-profile" style="color: #3a9e66;"></i> Edit Infomasi Alumni</h5>
            <hr>
            <p style="color: grey;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
            <hr>
            <form action="{{ route('frontend.profile-update', 'personal') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{ Auth::guard('alumni')->user()->nama }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ Auth::guard('alumni')->user()->email }}">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3">
                        {{ $dataAlumni->alamat }}
                    </textarea>

                    <input class="form-check-input" name="allow_alamat" type="checkbox" value="1" @if($dataAlumni->allow_view_alamat != '') checked @endif id="allow_alamat">
                    <label class="form-check-label" for="allow_alamat" style="color: #1a75d6; font-size: 13px;">
                        Ijinkan Alamat di publish
                    </label>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Telepon / HP</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Telepon / HP" value="{{ $dataAlumni->no_hp }}">

                    <input class="form-check-input" name="allow_telepon" type="checkbox" value="1" @if($dataAlumni->allow_view_no_hp != '') checked @endif id="allow_telepon">
                    <label class="form-check-label" for="allow_telepon" style="color: #1a75d6; font-size: 13px;">
                        Ijinkan Telepon / No HP di publish
                    </label>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                </div>

            </form>

        @elseif ($slug == 'lulusan')
            <h5><i class="bi bi-mortarboard  icon-menu-profile" style="color: #0317fc"></i> Edit Profil Lulusan Alumni</h5>
            <hr>
            <p style="color: grey;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
            <hr>
            <form action="{{ route('frontend.profile-update', 'lulusan') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">NPM (Tidak Wajib)</label>
                    <input type="text" name="nik" class="form-control" id="exampleFormControlInput1" placeholder="NPM" value="{{ Auth::guard('alumni')->user()->nik }}">
                </div>

                <div class="mb-3">
                    <label for="program_studi" class="form-label">Program Studi</label>
                    <select name="program_studi" id="program_studi" class="form-control">
                        <option value="">Pilih</option>
                        @foreach ([
                        "Teknik Pertambangan"=>"Teknik Pertambangan",
                        "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                        "Teknik Industri"=>"Teknik Industri"
                        ] as $programStudi => $prodiLabel)
                        <option value="{{ $programStudi }}" @if(!empty($programStudi == Auth::guard('alumni')->user()->program_studi)) selected @endif>{{ $prodiLabel }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" class="form-control" id="exampleFormControlInput1" placeholder="Tahun Lulus" @if($dataAlumni->tahun_lulus != '') value="{{ $dataAlumni->tahun_lulus }}" @endif>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                </div>
            </form>

        @elseif ($slug == 'jobs')

            <h5><i class="bi bi-suitcase-lg icon-menu-profile" style="color: #fc4e03;"></i> Riwayat Pekerjaan</h5>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun Masuk Bekerja</th>
                        <th scope="col">Tahun Berhenti Bekerja</th>
                        <th scope="col">Jenis Pekerjaan</th>
                        <th scope="col">Posisi Pekerjaan</th>
                        <th scope="col">Nama Perusahaan</th>
                        <th scope="col">Alamat Perusahaan</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($jobsAlumni as $ja => $value)
                        <tr>
                            <th scope="row">{{ $ja+1 }}</th>
                            <td>{{ $value->tahun_masuk_bekerja }}</td>
                            <td>{{ $value->tahun_berhenti_bekerja }}</td>
                            <td>{{ $value->jenis_pekerjaan }}</td>
                            <td>{{ $value->posisi }}</td>
                            <td>{{ $value->nama_perusahaan }}</td>
                            <td>{{ $value->lokasi_perusahaan }}</td>
                        </tr>
                    @endforeach   
                </tbody>
            </table>
            
            <h5 class="mt-5">Tambah Riwayat Pekerjaan</h5>
           
            <form action="{{ route('frontend.profile-update', 'jobs') }}" method="post" class="row g-3">
                @csrf
                <div class="field_wrapper">
                    <a href="javascript:void(0);" class="add_button" title="Tambah Item Pekerjaan"><i class="bi bi-plus-square-fill text-green-600"></i></a>
                    
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="tahun_masuk_bekerja" class="form-label">Tahun Masuk Bekerja</label>
                            <input type="text" class="form-control" id="tahun_masuk_bekerja" name="tahun_masuk_bekerja[]">
                        </div>
                        <div class="col-md-4">
                            <label for="tahun_berhenti_bekerja" class="form-label">Tahun Berhenti Bekerja</label>
                            <input type="text" class="form-control" id="tahun_berhenti_bekerja" name="tahun_berhenti_bekerja[]">
                        </div>
                        <div class="col-md-4">
                            <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan[]" id="jenis_pekerjaan" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ([
                                "ASN/BUMN"=>"ASN/BUMN",
                                "TNI"=>"TNI",
                                "POLRI"=>"POLRI",
                                "Swasta"=>"Swasta",
                                "Berwirausaha"=>"Berwirausaha",
                                "Tidak Bekerja"=>"Tidak Bekerja",
                                ] as $jenis_pekerjaan => $jenis_pekerjaanLabel)
                                <option value="{{ $jenis_pekerjaan }}">{{ $jenis_pekerjaanLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="posisi" class="form-label">Posisi Pekerjaan</label>
                            <textarea class="form-control" name="posisi[]" id="posisi" rows="3">
                                
                            </textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <textarea class="form-control" name="nama_perusahaan[]" id="nama_perusahaan" rows="3">
                                
                            </textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="alamat" class="form-label">Alamat Perusahaan</label>
                            <textarea class="form-control" name="alamat[]" id="alamat" rows="3">
                                
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                </div>
            </form>
        
        @elseif ($slug == 'kompetensi')

            <h5><i class="bi bi-shield-plus icon-menu-profile" style="color: #87036f;"></i> Kompetensi</h5>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kompetensi</th>
                        <th scope="col" class="text-center">Sertifikat Kompetensi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($skillAlumni as $sa => $value)
                        <tr>
                            <td scope="row">{{ $sa+1 }}</td>
                            <td>{{ $value->kompetensi }}</td>
                            <td class="text-center"><a href="{{ url('/alumni/sertifikat', $value->sertifikat_kompetensi) }}"><i class="bi bi-link-45deg"></i></a></td>
                        </tr>
                    @endforeach   
                </tbody>
            </table>
            
            <form action="{{ route('frontend.profile-update', 'kompetensi') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="field_wrapper">

                    {{-- <a href="javascript:void(0);" class="add_button_kompetensi" title="Tambah Item Pekerjaan"><i class="bi bi-plus-square-fill text-green-600"></i></a> --}}

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <label for="kompetensi" class="form-label">Kompetensi</label>
                            <input type="text" class="form-control" id="kompetensi" name="kompetensi">
                            {{-- <input type="text" class="form-control" id="kompetensi" name="kompetensi[]"> --}}
                        </div>

                        <div class="col-md-5">
                            <label for="sertifikat" class="form-label">Sertifikat Kompetensi</label>
                            <input class="form-control" type="file" id="sertifikat" name="sertifikat">
                            {{-- <input class="form-control" type="file" id="sertifikat" name="sertifikat[]"> --}}
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                </div>
            </form>

        @elseif ($slug == 'keahlian')

            <h5><i class="bi bi-wrench-adjustable icon-menu-profile" style="color: #04d4c6;"></i> Keahlian</h5>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Keahlian</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($keahlianAlumni as $ka => $value)
                        <tr>
                            <td scope="row">{{ $ka+1 }}</td>
                            <td>{{ $value->keahlian }}</td>  
                        </tr>
                    @endforeach   
                </tbody>
            </table>
            
            <form action="{{ route('frontend.profile-update', 'keahlian') }}" method="post">
                @csrf
                <div class="field_wrapper">

                    <a href="javascript:void(0);" class="add_button_keahlian" title="Tambah Item Keahlian"><i class="bi bi-plus-square-fill text-green-600"></i></a>

                    <div class="mb-3">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <input type="text" name="keahlian[]" class="form-control" placeholder="Jenis Keahlian">
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                </div>
            </form>

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

@endsection

@push('bottom_scripts')
    
<script>

    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var x = 1;
        var fieldHtml = '<div><div style="height: 10px;"></div><a href="javascript:void(0);" class="remove_button" title="Hapus Item Pekerjaan"><i class="bi bi-dash-square-fill"></i></a><div class="row mt-3"><div class="col-md-4"><label for="tahun_masuk_bekerja" class="form-label">Tahun Masuk Bekerja</label><input type="number" class="form-control" id="tahun_masuk_bekerja" name="tahun_masuk_bekerja[]"></div><div class="col-md-4"><label for="tahun_berhenti_bekerja" class="form-label">Tahun Berhenti Bekerja</label><input type="number" class="form-control" id="tahun_berhenti_bekerja" name="tahun_berhenti_bekerja[]"></div><div class="col-md-4"><label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan</label><select name="jenis_pekerjaan[]" id="jenis_pekerjaan" class="form-control"><option value="">Pilih</option>@foreach (["ASN/BUMN"=>"ASN/BUMN","TNI"=>"TNI","POLRI"=>"POLRI","Swasta"=>"Swasta","Berwirausaha"=>"Berwirausaha","Tidak Bekerja"=>"Tidak Bekerja",] as $jenis_pekerjaan => $jenis_pekerjaanLabel)<option value="{{ $jenis_pekerjaan }}">{{ $jenis_pekerjaanLabel }}</option>@endforeach</select></div></div><div class="row mt-3"><div class="col-md-4"><label for="posisi" class="form-label">Posisi Pekerjaan</label><textarea class="form-control" name="posisi[]" id="posisi" rows="3"></textarea></div><div class="col-md-4"><label for="nama_perusahaan" class="form-label">Nama Perusahaan</label><textarea class="form-control" name="nama_perusahaan[]" id="nama_perusahaan" rows="3"></textarea></div><div class="col-md-4"><label for="alamat" class="form-label">Alamat Perusahaan</label><textarea class="form-control" name="alamat[]" id="alamat" rows="3"></textarea></div></div></div>';

        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHtml);
            }
        })

        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

        /*
            var addButtonKompetensi = $('.add_button_kompetensi');
            var fieldHtmlKompetensi = '<div><div style="height: 10px;"></div><a href="javascript:void(0);" class="remove_button_kompetensi" title="Hapus Item Kompetensi"><i class="bi bi-dash-square-fill"></i></a><div class="row mt-3"><div class="col-md-7"><label for="kompetensi" class="form-label">Kompetensi</label><input type="text" class="form-control" id="kompetensi" name="kompetensi[]"></div><div class="col-md-5"><label for="sertifikat" class="form-label">Sertifikat Kompetensi</label><input class="form-control" type="file" id="sertifikat" name="sertifikat"></div></div></div>';

            $(addButtonKompetensi).click(function(){
                if(x < maxField){
                    x++;
                    $(wrapper).append(fieldHtmlKompetensi);
                }
            })

            $(wrapper).on('click', '.remove_button_kompetensi', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        */

        
        var addButtonKeahlian = $('.add_button_keahlian');
        var fieldHtmlKeahlian = '<div><div style="height: 10px;"></div><a href="javascript:void(0);" class="remove_button_keahlian" title="Hapus Item Keahlian"><i class="bi bi-dash-square-fill"></i></a><div class="mb-3"><label for="keahlian" class="form-label">Keahlian</label><input type="text" name="keahlian[]" class="form-control" placeholder="Jenis Keahlian"></div></div>';

        $(addButtonKeahlian).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHtmlKeahlian);
            }
        })

        $(wrapper).on('click', '.remove_button_keahlian', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
        
    })

</script>
    
@endpush