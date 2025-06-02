<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fakultas Teknik | UNISBA</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="{{ url('/kai/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ url('/kai/assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('/kai/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/kai/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/kai/assets/css/kaiadmin.min.css') }}" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- dropify file input -->
    <link rel="stylesheet" href="{{ url('/kai/assets/bower_components/dropify/dist/css/dropify.min.css')  }}">

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body>
    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main-panel">
            @include('layouts.header')

            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- /.content-wrapper -->
        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!--   Core JS Files   -->
    <script src="{{ url('/kai/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('/kai/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('/kai/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ url('/kai/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ url('/kai/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ url('/kai/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ url('/kai/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ url('/kai/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ url('/kai/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ url('/kai/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ url('/kai/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ url('/kai/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- dropify file upload -->
    <script src="{{ url('/kai/assets/bower_components/dropify/dist/js/dropify.min.js')  }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ url('/kai/assets/js/kaiadmin.min.js') }}"></script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>

    @include('sweetalert::alert')

    @stack('scripts_page')
</body>

</html>