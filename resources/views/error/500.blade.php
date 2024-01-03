<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ERROR 500</title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('img/logo-satgas-ppks-unimal.png') }}" type="image/x-icon">
    <link href="{{ asset('img/logo-satgas-ppks-unimal.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/23ce94eee2.js" crossorigin="anonymous"></script>


</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="error-content">
                        <div class="card mb-0">
                            <div class="card-body text-center">
                                <h1 class="error-text text-primary">500</h1>
                                <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Bad Request</h4>
                                <p>Your Request resulted in an error.</p>
                                <form class="mt-5 mb-5">

                                    <div class="text-center mb-4 mt-4"><a href="/" class="btn btn-primary">Go
                                            to Homepage</a>
                                    </div>
                                </form>
                                <div class="text-center">
                                    &copy; Copyright <strong><span>SATGAS PPKS UNIMAL</span></strong>. All Rights
                                    Reserved, Developed by <a href="https://github.com/abdrahman02" target="blank">M.
                                        Abdul Rahman</a></p>
                                    <ul class="list-inline">



                                        <li class="list-inline-item">
                                            <a href="https://www.instagram.com/ppks.unimal/" target="blank"
                                                class="btn btn-instagram"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://api.whatsapp.com/send/?phone=08116785223&text&type=phone_number&app_absent=0"
                                                target="blank" class="btn btn-whatsapp"><i
                                                    class="fa-brands fa-whatsapp"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://t.me/ppksunimal" target="blank" class="btn btn-google"><i
                                                    class="fa-brands fa-telegram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('backend/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/settings.js') }}"></script>
    <script src="{{ asset('backend/js/gleek.js') }}"></script>
    <script src="{{ asset('backend/js/styleSwitcher.js') }}"></script>
</body>

</html>