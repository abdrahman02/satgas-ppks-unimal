@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Jabatan</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="card custom-card">
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
                    @if ($jabatan->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                <th class="text-center border-bottom-0">Nama Jabatan</th>
                                <th class="text-center border-bottom-0">Level</th>
                                <th class="text-center border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $key => $item)
                            <tr>
                                <td class="text-center">{{ $jabatan->firstItem() + $key }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>{{ $item->level }}</td>
                                <td class="text-center">
                                    <a class="label label-warning link-warning mx-2" title="Edit" href="#"
                                        data-toggle="modal" data-target="#modal-ubh-item{{ $item->id }}">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('jabatan.destroy', $item->id) }}" method="post"
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
                        {{ $jabatan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>





{{-- Modal Tambah Data --}}
<div class="modal fade" id="modal-tbh-item" role="dialog" aria-hidden="true" style="overflow: hidden;" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="nama_jabatan" class="col-sm-2 col-lg-12">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" id="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror"
                                placeholder="Masukkan nama jabatan" value="{{ old('nama_jabatan') }}" autofocus
                                required>
                        </div>
                        <div class="row mb-3">
                            <label for="level" class="col-sm-2 col-lg-12">Level Jabatan</label>
                            <input type="text" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror"
                                placeholder="Masukkan nama jabatan" value="{{ old('level') }}" required>
                            <span class="text-warning"><i class="icon-info"></i>&nbsp;Contoh: <span
                                    class="font-italic">Ketua level 1, sekretaris level
                                    2, bendahara level 2, dll</span></span>
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





{{-- Modal Ubah Data --}}
@foreach ($jabatan as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-ubh-item{{ $id }}" role="dialog" aria-hidden="true" style="overflow: hidden;"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('jabatan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="nama_jabatan" class="col-sm-2 col-lg-12">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" id="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror"
                                placeholder="Masukkan tahun awal kepengurusan"
                                value="{{ old('nama_jabatan', $item->nama_jabatan) }}" autofocus required>
                        </div>
                        <div class="row mb-3">
                            <label for="level" class="col-sm-2 col-lg-12">Level Jabatan</label>
                            <input type="text" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror"
                                placeholder="Masukkan nama jabatan" value="{{ old('level', $item->level) }}" required>
                            <span class="text-warning"><i class="icon-info"></i>&nbsp;Contoh: <span
                                    class="font-italic">Ketua level 1, sekretaris level 2, bendahara level
                                    2, dll</span></span>
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