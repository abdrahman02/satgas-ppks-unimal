@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengguna</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="card custom-card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Daftar Akun Pengguna Website</h3>
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

                <div class="table-responsive">
                    @if ($pengguna->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                <th class="text-center border-bottom-0">Nama Pelanggan(ID Pelanggan)</th>
                                <th class="text-center border-bottom-0">Email </th>
                                <th class="text-center border-bottom-0">Username</th>
                                <th class="text-center border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengguna as $key => $item)
                            <tr>
                                <td class="text-center">{{ $pengguna->firstItem() + $key }}</td>
                                <td>{{ Str::words($item->name, 4) }}({{ $item->id }})</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->username }}</td>
                                <td class="text-center">
                                    <a class="label label-info link-info" title="Lihat" href="#" data-toggle="modal"
                                        data-target="#modal-lht-item{{ $item->id }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('pengguna.destroy', $item->id) }}" method="post"
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
                        {{ $pengguna->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>





{{-- Modal Lihat Data --}}
@foreach ($pengguna as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-lht-item{{ $id }}" role="dialog" aria-hidden="true" style="overflow: hidden;"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi Akun Pengguna Website</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span><strong>AKUN</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nama Pelanggan (ID Pelanggan)
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
@endsection