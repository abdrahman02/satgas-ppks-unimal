@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><span>Dashboard</span></li>
                <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Profil</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="container rounded bg-white mb-5">

            {{-- Alert --}}
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('success') }}</strong>
            </div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img id="profil-img" src="{{ asset('img/default-profile.jpg') }}" class="rounded-circle mt-5"
                            style="width: 200px;">
                        <span class="font-weight-bold">{{ $user->name }}</span>
                        <span class="text-black-50">{{ $user->email }}</span>
                        <span class="badge badge-info">{{ $user->role }}</span>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <form action="{{ route('profile.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Biodata</h4>
                            </div>

                            <div class="form-group mb-2">
                                <label class="name">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                    placeholder="Nama lengkap" id="name" name="name" required
                                    value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="form-group mb-2">
                                <label for="jenis_kelamin">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                    id="jenis_kelamin" name="jenis_kelamin" @if ($user->role == !'admin') required
                                    @endif>
                                    @if (empty($user->biodata->jenis_kelamin))
                                    <option value="" selected>-- PILIH --</option>
                                    @endif
                                    @foreach ($jenisKelamins as $item)
                                    <option value="{{ $item }}" @if (old('jenis_kelamin', $user->biodata ?
                                        $user->biodata->jenis_kelamin : '') === $item)
                                        selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($user->role == 'admin')
                                <span class="text-warning"><i class="icon-info"></i>&nbsp;Kosongkan jika
                                    admin</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <label for="nip_nim_nik">NIP/NIM/NIK<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('nip_nim_nik') is-invalid @enderror"
                                    id="nip_nim_nik" placeholder="Masukkan NIP/NIM/NIK" name="nip_nim_nik"
                                    @if($user->role == !'admin') required @endif
                                value="{{ old('nip_nim_nik', $user->biodata ? $user->biodata->nip_nim_nik : '') }}">
                                @if ($user->role == 'admin')
                                <span class="text-warning"><i class="icon-info"></i>&nbsp;Kosongkan jika
                                    admin</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <label for="no_telepon">Nomor Telepon/WA<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                    id="no_telepon" placeholder="Maasukkan nomor telepon..." name="no_telepon" value="{{ old('no_telepon',
                                $user->biodata ? $user->biodata->no_telepon : '') }}">
                            </div>

                            <div class="form-group mb-2">
                                <label for="status">Status Saat Ini<span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status" @if ($user->role == !'admin') required @endif>
                                    @if (empty($user->biodata->status))
                                    <option value="" selected>-- PILIH --</option>
                                    @endif
                                    @foreach ($statuses as $item)
                                    <option value="{{ $item }}" @if (old('status', $user->biodata ?
                                        $user->biodata->status :
                                        '') === $item)
                                        selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($user->role == 'admin')
                                <span class="text-warning"><i class="icon-info"></i>&nbsp;Kosongkan jika
                                    admin</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <label for="alamat">Alamat Lengkap<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat lengkap" id="alamat" name="alamat"
                                    @if($user->role == !'admin') required @endif
                                style="height: 100px">{{ old('alamat', $user->biodata ? $user->biodata->alamat : '') }}</textarea>
                            </div>

                            <div class="form-group mb-2">
                                <label for="tempat_lahir">Tempat lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    id="tempat_lahir" placeholder="Masukkan tempat lahir" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $user->biodata ? $user->biodata->tempat_lahir : '') }}"
                                    @if ($user->role == !'admin') required @endif>
                                @if ($user->role == 'admin')
                                <span class="text-warning"><i class="icon-info"></i>&nbsp;Kosongkan jika
                                    admin</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <label for="tanggal_lahir">Tanggal lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" placeholder="Masukkan tanggal lahir" name="tanggal_lahir"
                                    @if($user->role == !'admin') required @endif
                                value="{{ old('tanggal_lahir', $user->biodata ? $user->biodata->tanggal_lahir : '') }}">
                                @if ($user->role == 'admin')
                                <span class="text-warning"><i class="icon-info"></i>&nbsp;Kosongkan jika
                                    admin</span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary profile-button" type="submit">Simpan Biodata</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <form action="{{ route('registrasi.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Akun</h4>
                            </div>

                            <div class="d-flex justify-content-between align-items-center experience">
                                <button type="button" class="border px-3 p-1 add-experience" data-toggle="modal"
                                    data-target="#modalUbhPassword"><i class="fa fa-pencil"></i>&nbsp;Ubah
                                    Password</button>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" placeholder="Masukkan username" name="username" required
                                    value="{{ old('username', $user->username) }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Masukkan email" name="email" required
                                    value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary profile-button" type="submit">Simpan Akun</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>




{{-- Modal Ubah Password --}}
<div class="modal fade" id="modalUbhPassword">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('registrasi.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-3">
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" placeholder="Masukkan password lama" name="current_password"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" placeholder="Masukkan password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" placeholder="Masukkan ulang password"
                                name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Ubah Password --}}
@endsection