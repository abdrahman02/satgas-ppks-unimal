<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }} - SATGAS PPKS UNIMAL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('img/logo-satgas-ppks-unimal.png') }}" type="image/x-icon">
  <link href="{{ asset('img/logo-satgas-ppks-unimal.png') }}" rel="apple-touch-icon">

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('auth/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('auth/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('auth/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('auth/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('auth/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('auth/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('auth/css/vertical-layout-light/style.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->

  @stack('custom-style')

  <style>
    .text-open-sans {
      font-family: 'Open Sans', sans-serif;
    }

    .text-nunito {
      font-family: 'Nunito', sans-serif;
    }

    .text-poppins {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body>

  @yield('content')

  {{-- Jquery --}}
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
  {{-- Bootstrap --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>

  <!-- plugins:js -->
  <script src="{{ asset('auth/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('auth/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('auth/js/off-canvas.js') }}"></script>
  <script src="{{ asset('auth/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('auth/js/template.js') }}"></script>
  <script src="{{ asset('auth/js/settings.js') }}"></script>
  <script src="{{ asset('auth/js/todolist.js') }}"></script>
  <!-- endinject -->

  @stack('custom-script')
</body>

</html>