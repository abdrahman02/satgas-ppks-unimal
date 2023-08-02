@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Overview</a></li>
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

                <a href="{{ route('laporan.create') }}" class="btn btn-primary float-end">
                    <i class="fa fa-plus-circle"></i>&nbsp; Lapor!
                </a>

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
                                <th class="text-center border-bottom-0">Action</th>
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
                                <td class="text-center">
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
                                    @endif
                                    <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('laporan.destroy', $item->id) }}" method="post"
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
                                <th class="text-center border-bottom-0">Action</th>
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
                                <td class="text-center">
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
                                    <a class="label label-danger link-danger ml-3" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('laporan.destroy', $item->id) }}" method="post"
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
                        {{ $dataSelesai->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- #/ container -->
</div>
@endsection