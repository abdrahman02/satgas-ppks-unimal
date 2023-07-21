@extends('auth.layout.main')
@section('content')
<main class="container w-100 m-auto">
    <div class="container my-3">
        <div class="card m-auto shadow">
            <div class="card-header pb-0">
                <h1 class="h2 mb-3 fw-normal text-center">PENDAFTARAN</h1>
                <div class="logo col-lg-12 d-flex justify-content-center">
                    <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="logo" style="height: 100px;">
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('registrasi.store') }}" method="post">
                    @csrf

                    <h1 class="h5 mt-2 mb-1 fw-normal text-center text-nunito">AKUN</h1>
                    <div class="col-lg-6 d-flex justify-content-center">

                        <div class="col-lg-12">

                            <div class="form-floating mb-2">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Masukkan nama lengkap" name="name" required value="{{ old('name') }}">
                                <label for="name">Nama Lengkap</label>
                            </div>
                            @error('name')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-floating mb-2">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" placeholder="Masukkan username" name="username" required
                                    value="{{ old('username') }}">
                                <label for="username">Username</label>
                            </div>
                            @error('username')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-floating mb-2">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Masukkan email" name="email" required value="{{ old('email') }}">
                                <label for="email">Email</label>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-floating mb-2">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Masukkan password" name="password" required
                                    value="{{ old('password') }}">
                                <label for="password">Password</label>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <button class="w-25 mt-3 btn btn-lg btn-primary" type="submit"
                                style="display: none;">Daftar</button>

                            <p class="mt-3 mb-3 text-center text-body-secondary">Sudah memiliki akun? <a
                                    href="{{ route('login') }}" class="text-decoration-none">Masuk
                                    disini</a></p>
                            <p class="mt-2 mb-3 text-center text-body-secondary"> &copy; Copyright <strong><span>SATGAS
                                        PPKS
                                        UNIMAL</span></strong>. All Rights Reserved <br>Designed by <a
                                    class="text-decoration-none text-secondary" href="https://github.com/abdrahman02"
                                    target="blank">M. Abdul Rahman</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection