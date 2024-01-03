<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>
        {{ $title }} | Dashboard SATGAS PPKS UNIMAL
    </title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('img/logo-satgas-ppks-unimal.png') }}" type="image/x-icon">
    <link href="{{ asset('img/logo-satgas-ppks-unimal.png') }}" rel="apple-touch-icon">
    <!-- Pignose Calender -->
    <link href="{{ asset('backend/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet" />
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/chartist/css/chartist.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}" />
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <!-- Custom Stylesheet -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" />
    <!-- Tambahkan ini di head untuk mengimpor CSS cropperjs -->
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.min.css">

    @stack('custom-style')
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    @include('backend.partials.preloader')
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('backend.partials.header')

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('backend.partials.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        @include('backend.partials.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('backend/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/settings.js') }}"></script>
    <script src="{{ asset('backend/js/gleek.js') }}"></script>
    <script src="{{ asset('backend/js/styleSwitcher.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('backend/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('backend/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('backend/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('backend/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('backend/js/dashboard/dashboard-1.js') }}"></script>

    <script src="{{ asset('backend/plugins/cropperjs/dist/cropper.js') }}"></script>

    <script src="https://kit.fontawesome.com/23ce94eee2.js" crossorigin="anonymous"></script>


    @stack('custom-script')
</body>

</html>