@extends('auth.layout.main')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5 shadow">
                        <div class="brand-logo d-flex justify-content-center">
                            <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="logo">
                        </div>
                        <h4 class="text-center">PENDAFTARAN</h4>
                        <h6 class="fw-light text-center">Silahkan buat password anda untuk melanjutkan!</h6>
                        {{-- Error --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form class="pt-3" action="{{ route('registerGoogle') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password" placeholder="Masukkan password" name="password" required>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" placeholder="Masukkan kembali password"
                                    name="password_confirmation" required>
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                <small>{{ $message }}</small>
                            </div>
                            @enderror

                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">Masuk</button>
                            </div>
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