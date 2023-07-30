@extends('backend.layout.main')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Berita</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">

        <a class="label bg-primary text-white" href="{{ route('news.index') }}">
            <i class="fa fa-arrow-circle-o-left"></i>&nbsp; Kembali
        </a>
        <a class="label bg-warning text-white mx-2" href="{{ route('news.edit', $news->id) }}">
            <i class="fa fa-pencil-square-o"></i>&nbsp; Ubah
        </a>
        <a class="label bg-danger text-white" title="Hapus" href="#"
            onclick="if(confirm('Apakah anda yakin?')) {event.preventDefault(); document.getElementById('delete-form{{ $news->id }}').submit()};">
            <i class="fa fa-trash"></i>&nbsp; Hapus
            <form action="{{ route('news.destroy', $news->id) }}" method="post" id="delete-form{{ $news->id }}"
                class="d-none">
                @csrf
                @method('delete')
            </form>
        </a>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="d-flex align-items-center mb-sm-0 mb-2">
                                    <span class="fa fa-user-circle-o text-muted me-1 text-15"></span>&nbsp;
                                    <span class="mb-0 text-muted ms-2 text-13 me-sm-0 me-2">{{ $news->user->name
                                        }}</span>
                                </div>
                                <a href="#" class="d-f-ai-c mx-0 mb-sm-0 mb-2 mx-sm-4 mx-0 text-13">
                                    <span class="fa fa-calendar-o text-muted me-1 text-15"></span>
                                    <span class="mt-0 mt-0 text-muted">Upload : {{ $news->created_at->diffForHumans()
                                        }}</span>
                                </a>
                            </div>
                            <div>
                                <h3 class="font-weight-normal text-dark-light mt-4 mb-4">{{ $news->judul_berita }}
                                </h3>
                            </div>
                        </div>
                        <div class="ps-relative p-1 bg-light br-5">
                            @if (!empty($news->image) )
                            <img src="{{ asset('storage/berita/' . $news->image) }}" class="img-fluid">
                            @else
                            <img src="{{ asset('img/no-image-info.jpg') }}" class="img-fluid">
                            @endif
                        </div>
                        <div class=" mb-2 mt-5 content">
                            {!! $news->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection