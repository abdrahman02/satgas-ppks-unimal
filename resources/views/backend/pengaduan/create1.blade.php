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

        <div class="card custom-card shadow">
            <div class="card-header">
                <h3>Kirim Laporan Anda!</h3>
            </div>
            <div class="card-body">
                {{-- Error --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('laporan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-lg-3">
                            <p class="h4">INFORMASI PELAPOR</p>
                            <div class="row mb-3">
                                <label for="prodi" class="col-sm-2 col-lg-12">Prodi</label>
                                <input type="text" name="prodi" id="prodi"
                                    class="form-control @error('prodi') is-invalid @enderror"
                                    placeholder="Masukkan asal prodi" value="{{ old('prodi') }}" autofocus>
                            </div>
                            <div class="row mb-3">
                                <label for="fakultas" class="col-sm-2 col-lg-12">Fakultas</label>
                                <input type="text" name="fakultas" id="fakultas"
                                    class="form-control @error('fakultas') is-invalid @enderror"
                                    placeholder="Masukkan asal fakultas" value="{{ old('fakultas') }}">
                            </div>
                            <div class="row mb-3 form-group">
                                <label for="memiliki_disabilitas">Memiliki Disabilitas?<span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('nama_jabatan') is-invalid @enderror" required
                                    name="memiliki_disabilitas" id="memiliki_disabilitas">
                                    <option value="" {{ (old('memiliki_disabilitas')=='' ) ? 'selected' : '' }}>-- PILIH
                                        --
                                    </option>
                                    <option value="Ya" {{ (old('memiliki_disabilitas')=='Ya' ) ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak" {{ (old('memiliki_disabilitas')=='Tidak' ) ? 'selected' : ''
                                        }}>
                                        Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <p class="h4">INFORMASI PELAKU</p>
                            <div class="row mb-3">
                                <label for="nama_pelaku" class="col-sm-2 col-lg-12">Nama Pelaku (Jika
                                    Mengetahui)</label>
                                <input type="text" name="nama_pelaku" id="nama_pelaku"
                                    class="form-control @error('nama_pelaku') is-invalid @enderror"
                                    placeholder="Masukkan asal nama pelaku" value="{{ old('nama_pelaku') }}">
                            </div>
                            <div class="row mb-3 form-group">
                                <label for="status_pelaku">Status Pelaku<span class="text-danger">*</span></label>
                                <select class="form-control @error('nama_jabatan') is-invalid @enderror"
                                    name="status_pelaku" id="status_pelaku">
                                    <option value="" {{ (old('status_pelaku')=='' ) ? 'selected' : '' }}>-- PILIH --
                                    </option>
                                    <option value="Mahasiswa/i" {{ (old('status_pelaku')=='Mahasiswa/i' ) ? 'selected'
                                        : '' }}>Mahasiswa/i
                                    </option>
                                    <option value="Dosen" {{ (old('status_pelaku')=='Dosen' ) ? 'selected' : '' }}>
                                        Dosen</option>
                                    <option value="Tenaga Pendidik" {{ (old('status_pelaku')=='Tenaga Pendidik' )
                                        ? 'selected' : '' }}>
                                        Tenaga Pendidik</option>
                                    <option value="Masyarakat Umum" {{ (old('status_pelaku')=='Masyarakat Umum' )
                                        ? 'selected' : '' }}>
                                        Masyarakat Umum</option>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <label for="nim_nip_nik_pelaku" class="col-sm-2 col-lg-12">NIM/NIP/NIK Pelaku (Jika
                                    Mengetahui)</label>
                                <input type="text" name="nim_nip_nik_pelaku" id="nim_nip_nik_pelaku"
                                    class="form-control @error('nim_nip_nik_pelaku') is-invalid @enderror"
                                    placeholder="Masukkan nim/nip/nik pelaku" value="{{ old('nim_nip_nik_pelaku') }}">
                            </div>
                            <div class="row mb-3">
                                <label for="asal_instansi_pelaku" class="col-sm-2 col-lg-12">Asal Instansi
                                    (Prodi/Fakultas),
                                    "Jika Pelaku adalah lingkup Universitas</label>
                                <input type="text" name="asal_instansi_pelaku" id="asal_instansi_pelaku"
                                    class="form-control @error('asal_instansi_pelaku') is-invalid @enderror"
                                    placeholder="Masukkan asal instansi pelaku"
                                    value="{{ old('asal_instansi_pelaku') }}">
                            </div>
                            <div class="row mb-3">
                                <label for="kontak_pelaku" class="col-sm-2 col-lg-12">Kontak lain dari pelaku dapat
                                    berupa
                                    No. HP, akun media
                                    sosial dll (Jika Mengetahui)</label>
                                <input type="text" name="kontak_pelaku" id="kontak_pelaku"
                                    class="form-control @error('kontak_pelaku') is-invalid @enderror"
                                    placeholder="Masukkan kontak pelaku" value="{{ old('kontak_pelaku') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <p class="h4">INFORMASI KEJADIAN</p>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="kronologi_kejadian" class="col-sm-2 col-lg-12">Ceritakan kronologi
                                        kekerasan yang Anda alami, setelah ini pihak kami akan menghubungi agar lebih
                                        jelasnya.<span class="text-danger">*</span></label>
                                    <textarea
                                        class="form-control h-150px @error('kronologi_kejadian') is-invalid @enderror"
                                        rows="6" id="comment" placeholder="Masukkan kronologi kejadian"
                                        id="kronologi_kejadian" name="kronologi_kejadian"
                                        required>{{ old('kronologi_kejadian') }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="waktu_kejadian" class="col-sm-2 col-lg-12">Waktu Kejadian<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="waktu_kejadian" id="waktu_kejadian"
                                    class="form-control @error('waktu_kejadian') is-invalid @enderror"
                                    value="{{ old('waktu_kejadian') }}" required>
                            </div>
                            <div class="row mb-3">
                                <label for="bukti" class="col-sm-2 col-lg-12">Bukti<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" type="file" id="bukti" name="bukti"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary mr-2">
                            Kirim
                        </button>
                        <a href="{{ route('laporan.index') }}">
                            <button type="button" class="btn btn-danger">
                                Cancel
                            </button>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

@endsection