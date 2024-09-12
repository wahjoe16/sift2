@extends('layouts.portal.landing')

@section('content')

    <section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-12 offset-md-1">
                        <h1 class="display-6" style="font-weight: 600;">Portal Alumni <br>   Fakultas Teknik <br> UNISBA</h1>
                        <p>
                            Just like the old Bootstrap, but better. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio quibusdam quis, repudiandae reprehenderit doloremque fugiat molestias, corporis voluptas.
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
                                <form action="" method="post">@csrf
                                    <input type="text" name="nama" class="form-control form-control-lg rounded-pill" placeholder="Nama Lengkap">
                                    <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Email">
                                    <input type="text" name="npm" class="form-control form-control-lg rounded-pill" placeholder="NPM (Jika Masih Ingat)">
                                    <input type="password" name="password" class="form-control form-control-lg rounded-pill" placeholder="Sandi">
                                    <input type="password" name="confirm_password" class="form-control form-control-lg rounded-pill" placeholder="Konfirmasi Sandi">
                                    <button class="btn btn-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">Sudah punya akun?</button>
                                    <br><br>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-info text-white rounded-pill" type="button">Daftar</button>
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
                                <form action="" method="post">
                                    <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Email">
                                    <input type="password" name="password" class="form-control form-control-lg rounded-pill" placeholder="Sandi">
                                    <br>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-info text-white rounded-pill" type="button">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection