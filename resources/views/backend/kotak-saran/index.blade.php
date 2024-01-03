@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kotak Saran</a></li>
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

                @can('pengguna')
                <a href="#" class="btn btn-primary float-end" data-toggle="modal" data-target="#modal-tbh-item">
                    <i class="fa fa-plus-circle"></i>&nbsp; Kirim Saran
                </a>
                @endcan

                <div class="table-responsive">
                    @if ($sarans->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                <th class="text-center border-bottom-0">Satgas Bekerja Dengan Baik</th>
                                <th class="text-center border-bottom-0">Satgas Mengedukasi & Tanggap Dalam Laporan</th>
                                <th class="text-center border-bottom-0">Harapan & Saran</th>
                                <th class="text-center border-bottom-0">Respon Petugas</th>
                                <th class="text-center border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sarans as $key => $item)
                            <tr>
                                <td class="text-center">{{ $sarans->firstItem() + $key }}</td>
                                <td>{{ $item->satgas_bekerja_dengan_baik }}</td>
                                <td>{{ $item->satgas_mengedukasi_dan_tanggap_laporan }}</td>
                                <td>{{ Str::words($item->harapan_dan_saran, 3) }}</td>
                                @if (empty($item->respon_petugas))
                                <td><span class="text-warning fst-italic">Petugas belum merespon</span></td>
                                @else
                                <td>{{ Str::words($item->respon_petugas, 3) }}</td>
                                @endif
                                <td class="text-center">
                                    @can('pengguna')
                                    <a class="label label-warning link-warning mx-2" title="Edit" href="#"
                                        data-toggle="modal" data-target="#modal-ubh-item{{ $item->id }}">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    @endcan
                                    @can('petugas')
                                    <a class="label label-secondary link-secondary" title="Respon" href="#"
                                        data-toggle="modal" data-target="#modal-respon-item{{ $item->id }}">
                                        <i class="fa-solid fa-reply"></i>&nbsp;Respon
                                    </a>
                                    @endcan
                                    <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('kotak-saran.destroy', $item->id) }}" method="post"
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
                        {{ $sarans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>






{{-- Modal Respon Untuk Petugas --}}
@foreach ($sarans as $item)
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






{{-- Modal Tambah Data --}}
<div class="modal fade" id="modal-tbh-item" role="dialog" aria-hidden="true" style="overflow: hidden;" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('kotak-saran.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="satgas_bekerja_dengan_baik" class="col-sm-2 col-lg-12">Satgas Bekerja Dengan
                                Baik</label>
                            <select class="form-control @error('satgas_bekerja_dengan_baik') is-invalid @enderror"
                                name="satgas_bekerja_dengan_baik" id="satgas_bekerja_dengan_baik" required>
                                <option value="" selected>-- PILIH --</option>
                                <option value="Setuju">Setuju</option>
                                <option value="Tidak Setuju">Tidak Setuju</option>
                                <option value="Sangat Tidak Setuju">Sangat Tidak Setuju</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label for="satgas_mengedukasi_dan_tanggap_laporan" class="col-sm-2 col-lg-12">Satgas
                                Mengedukasi & Tanggap Dalam Laporan</label>
                            <select
                                class="form-control @error('satgas_mengedukasi_dan_tanggap_laporan') is-invalid @enderror"
                                name="satgas_mengedukasi_dan_tanggap_laporan"
                                id="satgas_mengedukasi_dan_tanggap_laporan" required>
                                <option value="" selected>-- PILIH --</option>
                                <option value="Setuju">Setuju</option>
                                <option value="Tidak Setuju">Tidak Setuju</option>
                                <option value="Sangat Tidak Setuju">Sangat Tidak Setuju</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label for="harapan_dan_saran" class="col-sm-2 col-lg-12">Tuliskan Harapan Dan Saran
                                mu</label>
                            <input type="text" name="harapan_dan_saran" id="harapan_dan_saran"
                                class="form-control @error('harapan_dan_saran') is-invalid @enderror"
                                placeholder="Masukkan harapan dan saran mu" value="{{ old('harapan_dan_saran') }}"
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





{{-- Modal Ubah Data --}}
@foreach ($sarans as $item)
@php
$id = $item->id;
@endphp
<div class="modal fade" id="modal-ubh-item{{ $id }}" role="dialog" aria-hidden="true" style="overflow: hidden;"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('kotak-saran.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row mb-3">
                            <label for="satgas_bekerja_dengan_baik" class="col-sm-2 col-lg-12">Satgas Bekerja Dengan
                                Baik</label>
                            <select class="form-control @error('satgas_bekerja_dengan_baik') is-invalid @enderror"
                                name="satgas_bekerja_dengan_baik" id="satgas_bekerja_dengan_baik" required>
                                <option value="Setuju" {{ $item->satgas_bekerja_dengan_baik == 'Setuju' ? 'selected' :
                                    '' }}>Setuju</option>
                                <option value="Tidak Setuju" {{ $item->satgas_bekerja_dengan_baik == 'Tidak Setuju' ?
                                    'selected' : '' }}>Tidak Setuju</option>
                                <option value="Sangat Tidak Setuju" {{ $item->satgas_bekerja_dengan_baik == 'Sangat
                                    Tidak Setuju' ? 'selected' : '' }}>Sangat Tidak Setuju</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label for="satgas_mengedukasi_dan_tanggap_laporan" class="col-sm-2 col-lg-12">Satgas
                                Mengedukasi & Tanggap Dalam Laporan</label>
                            <select
                                class="form-control @error('satgas_mengedukasi_dan_tanggap_laporan') is-invalid @enderror"
                                name="satgas_mengedukasi_dan_tanggap_laporan"
                                id="satgas_mengedukasi_dan_tanggap_laporan">
                                @if (empty($item->satgas_mengedukasi_dan_tanggap_laporan))
                                <option value="" selected>-- PILIH --</option>
                                @endif
                                <option value="Setuju" {{ old('satgas_mengedukasi_dan_tanggap_laporan', $item->
                                    satgas_mengedukasi_dan_tanggap_laporan) == 'Setuju' ? 'selected' : '' }}>Setuju
                                </option>
                                <option value="Tidak Setuju" {{ old('satgas_mengedukasi_dan_tanggap_laporan', $item->
                                    satgas_mengedukasi_dan_tanggap_laporan) == 'Tidak Setuju' ? 'selected' : '' }}>Tidak
                                    Setuju</option>
                                <option value="Sangat Tidak Setuju" {{
                                    old('satgas_mengedukasi_dan_tanggap_laporan',$item->
                                    satgas_mengedukasi_dan_tanggap_laporan) == 'Sangat Tidak Setuju' ? 'selected' : ''
                                    }}>Sangat Tidak Setuju</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label for="harapan_dan_saran" class="col-sm-2 col-lg-12">Tuliskan Harapan Dan Saran
                                mu</label>
                            <input type="text" name="harapan_dan_saran" id="harapan_dan_saran"
                                class="form-control @error('harapan_dan_saran') is-invalid @enderror"
                                placeholder="Masukkan harapan dan saran mu" required
                                value="{{ old('harapan_dan_saran', $item->harapan_dan_saran) }}">
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