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
        <div class="card custom-card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Form Ubah Berita</h3>
            </div>
            <div class="card-body">

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

                <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul_berita">
                            Judul Berita
                        </label>
                        <input class="form-control @error('judul_berita') is-invalid @enderror" id="judul_berita"
                            placeholder="Judul Berita" type="text" name="judul_berita" required autofocus
                            value="{{ old('judul_berita', $news->judul_berita) }}">
                        </input>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="image" class="form-label fw-bold">
                            Upload Gambar
                        </label>

                        @if ($news->image)
                        <img src="{{ asset('storage/berita/'.$news->image) }}" class="img-preview img-fluid mb-3"
                            style="max-width: 300px;">
                        @else
                        <img class="img-preview img-fluid mb-3" style="max-width: 300px;">
                        @endif

                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" onchange="previewImage()">
                        <input type="hidden" name="oldImage" value="{{ $news->image }}">
                    </div>

                    <div class="form-group">
                        <label for="body">
                            Isi Berita
                        </label>
                        <input id="body" name="body" type="hidden" required value="{{ old('body', $news->body) }}">
                        <trix-editor input="body"></trix-editor>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        Submit
                    </button>
                    <a href="{{ route('news.index') }}">
                        <button type="button" class="btn btn-danger">
                            Cancel
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection

@push('custom-script')
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        if(image.files.length > 0){
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            
            oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
            }
        }
    }
</script>
@endpush