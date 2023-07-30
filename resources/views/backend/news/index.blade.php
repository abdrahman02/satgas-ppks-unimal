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
        <div class="card">
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

                <a href="{{ route('news.create') }}" class="btn btn-primary float-end">
                    <i class="fa fa-plus-circle"></i>&nbsp; Tambah Data
                </a>

                <div class="table-responsive">
                    @if ($news->isNotEmpty())
                    <table class="table border text-nowrap text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom-0">No</th>
                                <th class="text-center border-bottom-0">Judul Berita</th>
                                <th class="text-center border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $key => $item)
                            <tr>
                                <td class="text-center">{{ $news->firstItem() + $key }}</td>
                                <td>{{ $item->judul_berita }}</td>
                                <td class="text-center">
                                    <a class="label label-info link-info" title="Lihat"
                                        href="{{ route('news.show', $item->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="label label-warning link-warning mx-2" title="Edit"
                                        href="{{ route('news.edit', $item->id) }}">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a class="label label-danger link-danger" title="Hapus" href="#"
                                        onclick="if(confirm('Apakah anda yakin?')) {
                                        event.preventDefault(); document.getElementById('delete-form{{ $item->id }}').submit()};">
                                        <i class="fa fa-trash"></i>
                                        <form action="{{ route('news.destroy', $item->id) }}" method="post"
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
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection