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
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body d-flex">
                        <div class="bag-1 col-8">
                            <h3 class="card-title text-white">Berita</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $jumlah_berita }}</h2>
                                <p class="text-white mb-0">{{ $bulanTahunPertama }} - {{ $bulanTahunTerbaru }}</p>
                            </div>
                        </div>
                        <div class="bag-2 col-4">
                            <span class="float-right display-5 opacity-5"><i class="fa fa-newspaper-o"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body d-flex">
                        <div class="bag-1 col-8">
                            <h3 class="card-title text-white">Data Sedang Proses</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $jumlah_OnProcess }}</h2>
                                <p class="text-white mb-0">{{ $bulanTahunOnProcessPertama }} - {{
                                    $bulanTahunOnProcessTerbaru }}</p>
                            </div>
                        </div>
                        <div class="bag-2 col-4">
                            <span class="float-right display-5 opacity-5"><i class="fa fa-clock-o"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body d-flex">
                        <div class="bag-1 col-8">
                            <h3 class="card-title text-white">Data Selesai</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $jumlah_Selesai }}</h2>
                                <p class="text-white mb-0">{{ $bulanTahunSelesaiPertama }} - {{
                                    $bulanTahunSelesaiTerbaru }}</p>
                            </div>
                        </div>
                        <div class="bag-2 col-4">
                            <span class="float-right display-5 opacity-5"><i class="fa fa-check-circle-o"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body d-flex">
                        <div class="bag-1 col-8">
                            <h3 class="card-title text-white">Pengguna</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $jumlah_Pengguna }}</h2>
                                <p class="text-white mb-0">{{ $bulanTahunPenggunaPertama }} - {{
                                    $bulanTahunPenggunaTerbaru }}</p>
                            </div>
                        </div>
                        <div class="bag-2 col-4">
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
</div>
@endsection