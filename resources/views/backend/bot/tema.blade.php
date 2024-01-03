@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">ChatBot</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="card custom-card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Daftar Tema Percakapan ChatBot</h3>
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
                    @if ($temas->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                <th class="text-center border-bottom-0">Tema</th>
                                <th class="text-center border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temas as $key => $item)
                            <tr>
                                <td class="text-center">{{ $temas->firstItem() + $key }}</td>
                                <td>{{ $item->tema }}</td>
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
                                        <form action="{{ route('tema.destroy', $item->id) }}" method="post"
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
                        {{ $temas->links() }}
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
            <form action="{{ route('tema.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="tema" class="col-sm-2 col-lg-12">Tema Percakapan</label>
                            <input type="text" name="tema" id="tema"
                                class="form-control @error('tema') is-invalid @enderror"
                                placeholder="Masukkan tema percakapan" value="{{ old('tema') }}" autofocus required>
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
@foreach ($temas as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-lht-item{{ $id }}" role="dialog" aria-hidden="true" style="overflow: hidden;"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi Tema Percakapan ChatBot</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        TEMA
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->tema }}
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






@foreach ($temas as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-ubh-item{{ $id }}" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('tema.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="tema" class="col-sm-2 col-lg-12">tema</label>
                            <input type="text" name="tema" id="tema"
                                class="form-control @error('tema') is-invalid @enderror"
                                placeholder="Masukkan tema percakapan" value="{{ old('tema', $item->tema) }}" autofocus
                                required>
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