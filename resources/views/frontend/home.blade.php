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
                    <div class="col-md-4 col-sm-12 offset-md-1 mt-auto mb-auto">
                        <div><button class="btn btn-outline-light btn-lg rounded-pill" style="padding-left: 30px; padding-right: 30px; width: 250px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">Sign up</button></div>
                        <br><br>
                        <div><button class="btn btn-primary btn-lg rounded-pill" style="padding-left: 30px; padding-right: 30px; width: 250px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">Sign in</button></div>

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
                                    <div class="mt-2 mb-2 text-end">
                                        <a href="{{ route('forgot.password.form') }}">Lupa Kata Sandi?</a>
                                    </div>
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
                    <div class="col-md-8 ms-auto me-auto">
                        @includeIf('layouts.alert')
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
                                    <h4 style="line-height: 40px; text-align:center; color: grey;" class="">Bidang Pekerjaan</h4>
                                </div>
                                <div class="card-body" style="height: 500px;">
                                    <canvas id="myChartBidangPekerjaan"></canvas>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="line-height: 40px; text-align:center; color: grey;" class="">Profesi</h4>
                                </div>
                                <div class="card-body" style="height: 500px;">
                                    <canvas id="myChartProfesiPekerjaan"></canvas>
                                </div>
                            </div>
                        </div>
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

    {{-- @includeIf('frontend.modal-form.view_profile') --}}   

@endsection

@push('login-register_scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        var namaBidang = [
            'Pemerintahan', 'Pendidikan', 'Industri / Manufaktur', 'Pertambangan', 'Konsultan', 'Hiburan', 
            'Ritel', 'Kesehatan', 'Keuangan', 'Lingkungan Hidup', 'Pertanian', 'Perikanan', 'Teknologi Informasi', 'Lainnya'
        ];

        var color = [
            '#026dc4', '#06b8a9', '#065903', '#f5d505', '#004b6b', '#ab5102', '#e80000',
            '#87db42','#09de14','#1bf7f3','#7e1bf7','#8c0088','#e80074','#bdc7c0'
        ];

        var dataBidangValues = @json(array_values($dataBidang));
        console.log(dataBidangValues);
        console.log(namaBidang);

        const ctx = document.getElementById('myChartBidangPekerjaan');

        const data = {
            labels: namaBidang,
            datasets: [{
                label: 'Bidang Pekerjaan Alumni',
                data: dataBidangValues,
                backgroundColor: color,
                hoverOffset: 4
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });

    </script>

    <script>

        var namaProfesi = ['ASN/BUMN', 'TNI', 'POLRI', 'Dosen', 'Guru' ,'Pegawai Swasta', 'Berwirausaha', 'Ibu Rumah Tangga'];

        var colorProfesi = ['#026dc4', '#06b8a9', '#71eb34', '#f5d505', '#f25c11', '#cc1dba', '#e80000', '#bdc7c0'];

        var dataProfesiValues = @json(array_values($dataProfesi));

        const ctx2 = document.getElementById('myChartProfesiPekerjaan');

        const data2 = {
            labels: namaProfesi,
            datasets: [{
                label: 'Profesi Alumni',
                data: dataProfesiValues,
                backgroundColor: colorProfesi,
                hoverOffset: 4
            }]
        };

        new Chart(ctx2, {
            type: 'pie',
            data: data2,
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });

    </script>
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

    {{-- <script>
        function viewAlumni(url) {
            $('#modal-form').modal('show');

            $.get(url)
                .done((response) => {
                    $('#modal-form .nama').text(response.nama);
                    $('#modal-form .jobsnow').text(response.pekerjaan_sekarang);
                    $('#modal-form .img-banner').html(`<img src="{{ url('user/banner/') }}/${response.banner_img}" class="card-img-top" style="max-width: 100%; height: 200px; object-fit: cover;">`);
                    $('#modal-form .foto-profile').html(`<img src="{{ url('user/foto/') }}/${response.foto}" class="rounded-circle foto-friend" style="position: relative; bottom: 68px; left: 20px;">`);
                    $('#modal-form .email').text(response.email);
                    $('#modal-form .hp').text(response.no_hp);

                    $('#modal-form .job-list').each(function(){
                        $(this).html('');
                        response.pekerjaan_lalu.forEach((job) => {
                            $(this).append(`<li>${job}</li>`);
                        });
                    });
                })
        }
    </script> --}}
@endpush