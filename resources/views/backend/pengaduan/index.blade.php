@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengaduan</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        @if (empty($user->biodata))
        <div class="alert alert-warning text-center" role="alert">
            Harap mengisi biodata terlebih dahulu!
        </div>
        @else

        {{-- Tabel Laporan Sedang Proses --}}
        <div class="card custom-card">
            <div class="card-header">
                <h3>Tabel Laporan Sedang Proses</h3>
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

                @can('pengguna')
                <a href="{{ route('laporan.create') }}" class="btn btn-primary float-end">
                    <i class="fa fa-plus-circle"></i>&nbsp; Lapor!
                </a>
                @endcan

                <div class="table-responsive">
                    @if ($dataOnProcess->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                @if ($user->role == 'petugas')
                                <th class="text-center border-bottom-0">Nama Pelapor</th>
                                @endif
                                <th class="text-center border-bottom-0">Kronologi Kejadian</th>
                                <th class="text-center border-bottom-0">Waktu Kejadian</th>
                                <th class="text-center border-bottom-0">Tanggal Lapor</th>
                                <th class="text-center border-bottom-0">Respon</th>
                                @can('petugas')
                                <th class="text-center border-bottom-0">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataOnProcess as $key => $item)
                            <tr>
                                <td class="text-center">{{ $dataOnProcess->firstItem() + $key }}</td>
                                @if ($user->role == 'petugas')
                                <td>{{ $item->user->name }}</td>
                                @endif
                                <td>{{ Str::words($item->kronologi_kejadian, 4) }}</td>
                                <td>{{ $item->waktu_kejadian }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                @if (empty($item->respon_petugas))
                                <td><span class="text-warning fst-italic">Petugas belum merespon</span></td>
                                @else
                                <td>{{ Str::words($item->respon_petugas, 5) }}</td>
                                @endif
                                @can ('petugas')
                                <td class="text-center">
                                    <a class="label label-info link-info" title="Lihat" href="#" data-toggle="modal"
                                        data-target="#modal-lht-item-sedang-proses{{ $item->id }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if ($user->role == 'petugas')
                                    <a class="label label-warning link-warning mx-2 text-white" title="Edit" href="#"
                                        onclick="if(confirm('Apakah anda yakin ingin mengubah progres status kasus menjadi Selesai?')) {
                                            event.preventDefault(); document.getElementById('ubhKeSelesai{{ $item->id }}').submit()};">
                                        <i class="fa fa-check-square-o"></i>&nbsp;Selesaikan
                                        <form action="{{ route('laporan.update', $item->id) }}" method="post"
                                            id="ubhKeSelesai{{ $item->id }}" class="d-none">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="ubhKeSelesai" value="Selesai">
                                        </form>
                                    </a>
                                    <a class="label label-secondary link-secondary" title="Respon" href="#"
                                        data-toggle="modal" data-target="#modal-respon-item{{ $item->id }}">
                                        <i class="fa-solid fa-reply"></i>&nbsp;Respon
                                    </a>
                                    @endif
                                    {{-- <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('laporan.destroy', $item->id) }}" method="post"
                                            id="delete-form{{ $item->id }}" class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </a> --}}
                                </td>
                                @endcan
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
                        {{ $dataOnProcess->links() }}
                    </div>
                </div>
            </div>
        </div>


        {{-- Tabel Laporan Selesai --}}
        <div class="card custom-card">
            <div class="card-header">
                <h3>Tabel Laporan Selesai</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    @if ($dataSelesai->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                @if ($user->role == 'petugas')
                                <th class="text-center border-bottom-0">Nama Pelapor</th>
                                @endif
                                <th class="text-center border-bottom-0">Kronologi Kejadian</th>
                                <th class="text-center border-bottom-0">Waktu Kejadian</th>
                                <th class="text-center border-bottom-0">Tanggal Lapor</th>
                                <th class="text-center border-bottom-0">Respon</th>
                                @can('petugas')
                                <th class="text-center border-bottom-0">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSelesai as $key => $item)
                            <tr>
                                <td class="text-center">{{ $dataSelesai->firstItem() + $key }}</td>
                                @if ($user->role == 'petugas')
                                <td>{{ $item->user->name }}</td>
                                @endif
                                <td>{{ Str::words($item->kronologi_kejadian, 4) }}</td>
                                <td>{{ $item->waktu_kejadian }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                @if (empty($item->respon_petugas))
                                <td><span class="text-warning fst-italic">Petugas belum merespon</span></td>
                                @else
                                <td>{{ Str::words($item->respon_petugas, 5) }}</td>
                                @endif
                                @can('petugas')
                                <td class="text-center">
                                    <a class="label label-info link-info" title="Lihat" href="#" data-toggle="modal"
                                        data-target="#modal-lht-item-selesai{{ $item->id }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if ($user->role == 'petugas')
                                    <a class="label label-warning link-warning mx-2 text-white" title="Edit" href="#"
                                        onclick="if(confirm('Apakah anda yakin ingin mengubah progres status kasus menjadi Sedang Proses?')) {
                                            event.preventDefault(); document.getElementById('ubhKeSedangProses{{ $item->id }}').submit()};">
                                        <i class="fa fa-check-square-o"></i>&nbsp;Batalkan Selesai
                                        <form action="{{ route('laporan.update', $item->id) }}" method="post"
                                            id="ubhKeSedangProses{{ $item->id }}" class="d-none">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="ubhKeSedangProses" value="Sedang Proses">
                                        </form>
                                    </a>
                                    @endif
                                    {{-- <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('laporan.destroy', $item->id) }}" method="post"
                                            id="delete-form{{ $item->id }}" class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </a> --}}
                                </td>
                                @endcan
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
                        {{ $dataSelesai->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- #/ container -->
</div>





{{-- Modal Lihat Data Sedang Proses --}}
@if ($dataOnProcess->isNotEmpty())
@foreach ($dataOnProcess as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-lht-item-sedang-proses{{ $id }}" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <span><strong>INFORMASI PELAPOR</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nama Pelapor (ID Pelapor)
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->user->name }}({{ $item->user_id }})
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Prodi Pelapor
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->prodi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Fakultas Pelapor
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->fakultas }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Memiliki Disabilitas
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->memiliki_disabilitas }}
                    </div>
                </div>

                <span><strong>INFORMASI PELAKU</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nama Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->nama_pelaku }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nim/Nip/Nik Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->nim_nip_nik_pelaku }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Asal Instansi Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->asal_instansi_pelaku }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Kontak Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->kontak_pelaku }}
                    </div>
                </div>

                <span><strong>INFORMASI KEJADIAN</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Kronologi Kejadian
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->kronologi_kejadian }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Waktu Kejadian
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->waktu_kejadian }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Bukti
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->bukti)
                        <i class="fa-regular fa-circle-check text-success"></i>
                        @else
                        <i class="fa-regular fa-circle-xmark text-danger"></i>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Respon
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->respon_petugas)
                        {{ $item->respon_petugas }}
                        @else
                        <i class="fa-regular fa-circle-xmark text-danger"></i>
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
@endif





{{-- Modal Lihat Data Selesai Proses --}}
@if ($dataSelesai->isNotEmpty())
@foreach ($dataSelesai as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-lht-item-selesai{{ $id }}" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <span><strong>INFORMASI PELAPOR</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nama Pelapor (ID Pelapor)
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->user->name }}({{ $item->user_id }})
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Prodi Pelapor
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->prodi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Fakultas Pelapor
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->fakultas }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Memiliki Disabilitas
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        : {{ $item->memiliki_disabilitas }}
                    </div>
                </div>

                <span><strong>INFORMASI PELAKU</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nama Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->nama_pelaku }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Nim/Nip/Nik Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->nim_nip_nik_pelaku }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Asal Instansi Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->asal_instansi_pelaku }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Kontak Pelaku
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->kontak_pelaku }}
                    </div>
                </div>

                <span><strong>INFORMASI KEJADIAN</strong></span>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Kronologi Kejadian
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->kronologi_kejadian }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Waktu Kejadian
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        {{ $item->waktu_kejadian }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Bukti
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->bukti)
                        <i class="fa-regular fa-circle-check text-success"></i>
                        @else
                        <i class="fa-regular fa-circle-xmark text-danger"></i>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Respon
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        :
                        @if ($item->respon_petugas)
                        {{ $item->respon_petugas }}
                        @else
                        <i class="fa-regular fa-circle-xmark text-danger"></i>
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
@endif







@foreach ($dataOnProcess as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-respon-item{{ $id }}" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('laporan.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="respon_petugas" class="col-sm-2 col-lg-12">Respon Petugas</label>
                            <textarea class="form-control h-150px @error('respon_petugas') is-invalid @enderror"
                                rows="6" id="respon_petugas" placeholder="Masukkan respon petugas" id="respon_petugas"
                                name="respon_petugas" required autofocus>{{ old('respon_petugas') }}</textarea>
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