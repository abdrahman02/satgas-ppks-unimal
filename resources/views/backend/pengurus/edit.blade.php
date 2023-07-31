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
            <div class="card">
                <div class="card-header">
                    <h3>Ubah Data Pengurus</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-3">

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

                            <div class="row mb-3">
                                <label for="nama_pengurus" class="col-sm-2 col-lg-12">Nama Pengurus</label>
                                <input type="text" name="nama_pengurus" id="nama_pengurus"
                                    class="form-control @error('nama_pengurus') is-invalid @enderror"
                                    placeholder="Masukkan nama pengurus"
                                    value="{{ old('nama_pengurus', $pengurus->nama_pengurus) }}" autofocus required>
                            </div>
                            <div class="row mb-3">
                                <label for="latar_belakang" class="col-sm-2 col-lg-12">Latar Belakang</label>
                                <input type="text" name="latar_belakang" id="latar_belakang"
                                    class="form-control @error('latar_belakang') is-invalid @enderror"
                                    placeholder="Masukkan latar belakang pengurus"
                                    value="{{ old('latar_belakang', $pengurus->latar_belakang) }}" required>
                                <span class="text-warning"><i class="icon-info"></i>&nbsp; Contoh: <span
                                        class="font-italic">Dosen FH/Mahasiswa FH</span></span>
                            </div>
                            <div class="row mb-3 form-group">
                                <label for="jabatan_id">Nama Jabatan</label>
                                <select class="form-control @error('nama_jabatan') is-invalid @enderror"
                                    name="jabatan_id" id="jabatan_id">
                                    @if (empty($pengurus->jabatan->nama_jabatan))
                                    <option value="" selected>-- PILIH --</option>
                                    @endif
                                    @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}" @if (old('jabatan_id', $pengurus->
                                        jabatan_id)===$item->id)
                                        selected @endif>{{ $item->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3 form-group">
                                <label for="periode_id">Masa Periode</label>
                                <select class="form-control @error('periode_id') is-invalid @enderror" name="periode_id"
                                    id="periode_id">
                                    @if (empty($pengurus->periode->masa_periode))
                                    <option value="" selected>-- PILIH --</option>
                                    @endif
                                    @foreach ($periode as $item)
                                    <option value="{{ $item->id }}" @if(old('periode_id', $pengurus->
                                        periode_id)===$item->id)
                                        selected
                                        @endif>
                                        {{ $item->masa_periode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label for="image" class="form-label fw-bold">
                                    Upload Gambar
                                </label>

                                @if ($pengurus->image)
                                <img src="{{ asset('storage/struktur-organisasi/'.$pengurus->image) }}"
                                    class="img-preview img-fluid mb-3" style="max-width: 300px;">
                                @else
                                <img class="img-preview img-fluid mb-3" style="max-width: 300px;">
                                @endif

                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                    name="image" onchange="previewImage()">
                                <input type="hidden" name="oldImage" value="{{ $pengurus->image }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            Submit
                        </button>
                        <a href="{{ route('pengurus.index') }}">
                            <button type="button" class="btn btn-danger">
                                Cancel
                            </button>
                        </a>
                    </form>
                </div>
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