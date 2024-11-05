@extends('layouts.portal.landing')

@section('content')

    <section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-12 offset-md-1">
                        <h1 class="display-6" style="font-weight: 600;">Alumni <br>   Fakultas Teknik <br> UNISBA</h1>
                        <p class="mt-5">
                            Halaman media sosial alumni fakultas teknik UNISBA yang dirancang untuk silaturahmi antar alumni, <i>tracing</i> alumni,
                            dan segala hal positif yang bisa dibagikan antar alumni.
                        </p>
                        <button type="submit" class="btn btn-info btn-md text-white rounded-pill">Selengkapnya</button>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <button class="btn btn-outline-light btn-lg rounded-pill" style="padding-left: 30px; padding-right: 30px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">Sign up</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-outline-light btn-lg rounded-pill" style="padding-left: 30px; padding-right: 30px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">Sign in</button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header header-canvas">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Daftar Sekarang!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body body-canvas">
                                {{-- <form id="registerForm" action="{{ route('frontend.register') }}" method="post">@csrf --}}
                                <form id="registerForm" action="{{ route('frontend.register') }}" method="post">@csrf 
                                    <input type="text" name="nama" class="form-control form-control-lg rounded-pill" placeholder="Nama Lengkap" required>
                                    <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Email" required>
                                    <input type="text" name="nik" class="form-control form-control-lg rounded-pill" placeholder="NPM (Tidak Wajib)">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg rounded-pill" placeholder="Sandi" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    <input type="password" id="password" name="password_confirmation" class="form-control form-control-lg rounded-pill" placeholder="Konfirmasi Sandi" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    <button class="btn btn-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">Sudah punya akun?</button>
                                    <br><br>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-info text-white rounded-pill" type="submit">Sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight2" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header header-canvas">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Masuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body body-canvas">
                                <form action="{{ route('frontend.login') }}" method="post">@csrf
                                    <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Email">
                                    <input type="password" name="password" class="form-control form-control-lg rounded-pill" placeholder="Kata Sandi">
                                    <br>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-info text-white rounded-pill" type="submit">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center mt-5">
                    <div class="col-md-12">
                        @includeIf('layouts.alert')
                    </div>
        
                </div>
            </div>
        </div>
    </section>

    <section id="list-alumni">
        <div class="container">
            <div class="feature-content">
                <div class="row">
                    <div class="col-lg-8">
                        <table class="table table-hover table-list-alumni">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th></th>
                            </thead>
                        </table>
                    </div>
                    <div class="col-lg-3 offset-lg-1 mb-auto mt-auto">
                        <h2 style="line-height: 40px; text-align:center; color: grey;" class="">Alumni-alumni Fakultas Teknik UNISBA</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="angkatan-chart">
        <div class="feature-content">
            <div class="container">
                <h2>Presentasi Pekerjaan</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-group">
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="line-height: 40px; text-align:center; color: grey;" class="">Presentasi Jenis Pekerjaan Alumni</h4>
                                </div>
                                <div class="card-body">
                                    {!! $angkatanAlumniChart->container() !!}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="line-height: 40px; text-align:center; color: grey;" class="">Presentasi Bidang Pekerjaan Alumni</h4>
                                </div>
                                <div class="card-body">
                                    {!! $bidangPekerjaanAlumniChart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ $angkatanAlumniChart->cdn() }}"></script>
    <script src="{{ $bidangPekerjaanAlumniChart->cdn() }}"></script>

    {{ $angkatanAlumniChart->script() }}
    {{ $bidangPekerjaanAlumniChart->script() }}

@endsection

@push('login-register_scripts')
    {{-- <script>
        $(document).ready(function(){
            // register alumni with ajax
            $("#registerForm").submit(function(){
                var formdata = $(this).serialize();
                $.ajax({
                    url: "{{ route('frontend.register') }}",
                    type: "POST",
                    data: formdata,
                    success: function(resp){
                        alert(resp.url);
                        window.location.href = resp.url;
                    }, error: function(){
                        alert("Gagal mendaftar");
                    }
                })
            })

            // $('.table-list-alumni').DataTable();
        })
    </script> --}}

    <script>
        let table;

        $(function(){
            table = $('.table-list-alumni').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route("frontend.data-friend-alumni") }}',
                },
                columns: [{
                    data: 'foto',
                    searchable: false,
                    sortable: false
                }, {
                    data: 'users.nama'
                }, {
                    data: 'program_studi'
                }, {
                    data: 'angkatan'
                }, {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                }]
            })
        })

    </script>
@endpush