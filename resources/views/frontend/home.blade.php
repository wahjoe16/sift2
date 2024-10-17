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
                        <button class="btn btn-outline-light btn-lg rounded-pill" style="padding-left: 30px; padding-right: 30px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">Daftar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-outline-light btn-lg rounded-pill" style="padding-left: 30px; padding-right: 30px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">Masuk</button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header header-canvas">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Daftar Sekarang!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body body-canvas">
                                {{-- <form id="registerForm" action="{{ route('frontend.register') }}" method="post">@csrf --}}
                                <form id="registerForm" action="javascript:;" method="post">@csrf 
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
                                        <button class="btn btn-info text-white rounded-pill" type="submit">Daftar</button>
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
                                        <button class="btn btn-info text-white rounded-pill" type="submit">Masuk</button>
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

@endsection

@push('login-register_scripts')
    <script>
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
        })
    </script>
@endpush