@extends('auth.layout.main')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo d-flex justify-content-center">
                            <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="logo">
                        </div>
                        <h4 class="text-center">PENDAFTARAN</h4>
                        <h6 class="fw-light text-center">Silahkan mengisi formulir dibawah ini.</h6>
                        <form class="pt-3">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror" id="name"
                                    placeholder="Masukkan nama lengkap" name="name" required value="{{ old('name') }}">
                            </div>
                            @error('name')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-lg @error('username') is-invalid @enderror"
                                    id="username" placeholder="Masukkan username" name="username" required
                                    value="{{ old('username') }}">
                            </div>
                            @error('username')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                                    placeholder="Masukkan email" name="email" required value="{{ old('email') }}">
                            </div>
                            @error('email')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-group">
                                <input type=" password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password" placeholder="Masukkan password" name="password" required
                                    value="{{ old('password') }}">
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">Daftar</button>
                            </div>
                            <p class="mt-3 mb-3 text-center text-body-secondary">Sudah memiliki akun? <a
                                    href="{{ route('login') }}" class="text-decoration-none">Masuk
                                    disini</a></p>
                            <p class="mt-2 text-center text-body-secondary"> &copy; Copyright <strong><span>SATGAS
                                        PPKS
                                        UNIMAL</span></strong>. All Rights Reserved <br>Designed by <a
                                    class="text-decoration-none text-secondary" href="https://github.com/abdrahman02"
                                    target="blank">M. Abdul Rahman</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@endsection