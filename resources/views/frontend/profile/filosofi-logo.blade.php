@extends('frontend.layout.main')
@section('content')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Profil</li>
                <li>Filosofi Logo</li>
            </ol>
            <h2>Filosofi Logo</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="flosofi-logo">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="row">
                <header class="section-header mb-3">
                    <h2>Makna</h2>
                </header>
                <div class="col-lg-6">
                    <img src="{{ asset('img/makna-logo.webp') }}" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('img/makna-tagline.webp') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
@endsection