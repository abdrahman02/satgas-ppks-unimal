@extends('auth.layout.main')
@section('content')
<main>
    <div class="container my-5">
        <div class="card col-lg-5 m-auto shadow">
            <div class="card-header pb-0">
                <h1 class="h2 mb-3 fw-bold text-center">Masuk</h1>
                <div class="logo col-lg-12 d-flex justify-content-center mb-3">
                    <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="logo" style="height: 100px;">
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text"
                            class="form-control form-control-lg @error('email_or_username') is-invalid @enderror"
                            id="email_or_username" placeholder="Masukkan email atau username..."
                            name="email_or_username" autofocus required value="{{ old('email_or_username') }}">
                        {{-- <label for="email_or_username">Email atau username</label> --}}
                    </div>
                    @error('email_or_username')
                    <div class="invalid-feedback">
                        <small>{{ $message }}</small>
                    </div>
                    @enderror

                    <div class="form-group">
                        <input type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"
                            placeholder="Password" name="password" required value="{{ old('password') }}">
                        {{-- <label for="password">Password</label> --}}
                    </div>
                    @error('password')
                    <div class="invalid-feedback">
                        <small>{{ $message }}</small>
                    </div>
                    @enderror

                    <button class="w-100 btn btn-md btn-primary" type="submit">Masuk</button>
                    <p class="mt-3 mb-3 text-center text-body-secondary">Belum memiliki akun? <a
                            href="{{ route('registrasi.index') }}" class="text-decoration-none">Daftar
                            disini</a></p>

                    <div class="mb-2 d-flex justify-content-center">
                        <button type="button" class="btn btn-block btn-google auth-form-btn">
                            <i class="mdi mdi-google"></i>&nbsp;Masuk menggunakan Google
                        </button>
                    </div>
                    <div class="mb-2 d-flex justify-content-center">
                        <a href="/" class="btn btn-block btn-warning auth-form-btn">
                            <i class="mdi mdi-home"></i>&nbsp;Beranda
                        </a>
                    </div>

                    <p class="mt-5 mb-3 text-center text-body-secondary"> &copy; Copyright <strong><span>SATGAS PPKS
                                UNIMAL</span></strong>. All Rights Reserved <br>Designed by <a
                            class="text-decoration-none text-secondary" href="https://github.com/abdrahman02"
                            target="blank">M. Abdul Rahman</a>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection