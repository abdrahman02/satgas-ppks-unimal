@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Author</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="card custom-card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Daftar Akun Author Website</h3>
            </div>
            <div class="card-body">

                {{-- Alert Success --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle-o me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
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

                <a href="#" class="btn btn-primary float-end" data-toggle="modal" data-target="#modal-tbh-item">
                    <i class="fa fa-plus-circle"></i>&nbsp; Tambah Data
                </a>

                <div class="table-responsive">
                    @if ($author->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                <th class="text-center border-bottom-0">Nama Author(ID Author)</th>
                                <th class="text-center border-bottom-0">Email </th>
                                <th class="text-center border-bottom-0">Username</th>
                                <th class="text-center border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($author as $key => $item)
                            <tr>
                                <td class="text-center">{{ $author->firstItem() + $key }}</td>
                                <td>{{ Str::words($item->name, 4) }}({{ $item->id }})</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->username }}</td>
                                <td class="text-center">
                                    <a class="label label-info link-info" title="Lihat" href="#" data-toggle="modal"
                                        data-target="#modal-lht-item{{ $item->id }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="label label-warning link-warning mx-3" title="Edit" href="#"
                                        data-toggle="modal" data-target="#modal-ubh-item{{ $item->id }}">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a class="label label-danger link-danger" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('author.destroy', $item->id) }}" method="post"
                                            id="delete-form{{ $item->id }}" class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <div class="alert alert-primary text-center" role="alert">
                            Data is empty, please add data first!!
                        </div>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $author->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>






{{-- Modal Tambah Data --}}
<div class="modal fade" id="modal-tbh-item" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('author.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-lg-12">Nama Author</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama author" value="{{ old('name') }}" autofocus required>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-lg-12">Username</label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="Masukkan username author" value="{{ old('username') }}" required>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-lg-12">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email author" value="{{ old('email') }}" required>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-lg-12">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password author" value="{{ old('password') }}" required>
                        </div>
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-2 col-lg-12">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Masukkan ulang password author" value="{{ old('password_confirmation') }}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>






{{-- Modal Lihat Data --}}
@foreach ($author as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-lht-item{{ $id }}" role="dialog" aria-hidden="true" style="overflow: hidden;"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi Akun Author Website</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span><strong>AKUN</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nama Author (ID Author)
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->name }}({{ $item->id }})
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Email
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->email }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Username
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->username }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Member Since
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->created_at->format('d-M-Y') }}
                    </div>
                </div>

                <span><strong>BIODATA</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        NIP/NIM/NIK
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->nip_nim_nik }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Status
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->status }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Tempat Lahir
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->tempat_lahir }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Tanggal Lahir
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->tanggal_lahir }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Jenis Kelamin
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->jenis_kelamin }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        No Telepon
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->no_telepon }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Alamat
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->biodata)
                        {{ $item->biodata->alamat }}
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <a class="badge bg-indigo text-white" href="#" data-dismiss="modal" aria-label="Close">
                            <i class="fe fe-arrow-left"></i>&nbsp; Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach






@foreach ($author as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-ubh-item{{ $id }}" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('author.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-lg-12">Nama author</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama author" value="{{ old('name', $item->name) }}" autofocus
                                required>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-lg-12">Username</label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="Masukkan username author" value="{{ old('username', $item->username) }}"
                                required>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-lg-12">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email author" value="{{ old('email', $item->email) }}" required>
                        </div>
                        <div class="row mb-3">
                            <label for="current_password" class="col-sm-2 col-lg-12">Password Lama</label>
                            <input type="password" name="current_password" id="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Masukkan password sekarang author" required>
                        </div>
                        <div class="row mb-3">
                            <label for="new_password" class="col-sm-2 col-lg-12">Password Baru</label>
                            <input type="password" name="new_password" id="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                placeholder="Masukkan password baru author" required>
                        </div>
                        <div class="row mb-3">
                            <label for="new_password_confirmation" class="col-sm-2 col-lg-12">Konfirmasi Password
                                Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                placeholder="Masukkan password ulang baru author" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection