@extends('auth.layout.main')
@section('content')

<div class="card justify-content-center p-4 shadow-md">
    <h4 class="h4">Verifikasi Email Anda!</h4>
    <hr>
    @if (session()->has('resent'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('resent') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <p>Kami sudah mengirimkan email verifikasi ke alamat email anda!, silahkan cek email anda!</p>
    <p>Jika anda tidak menerima email verifikasi, <a href="#"
            onclick="event.preventDefault(); document.getElementById('resend-email').submit()">Klik disini </a>untuk
        mengirim kembali email verifikasi
    </p>
    <form action="{{ route('verification.resend', $user->id) }}" method="post" id="resend-email" class="d-none">
        @csrf
    </form>
</div>

@endsection