<h1 class="h5 mt-2 mb-1 fw-normal text-center text-nunito">BIODATA</h1>
<div class="col-lg-12 d-flex flex-row gap-3 justify-content-center">
    <div class="col-lg-4">
        <div class="form-floating mb-2">
            <input type="text" class="form-control  @error('nip_nim_nik') is-invalid @enderror" id="nip_nim_nik"
                placeholder="Masukkan NIP/NIM/NIK" name="nip_nim_nik" required autofocus
                value="{{ old('nip_nim_nik') }}">
            <label for="nip_nim_nik">NIP/NIM/NIK</label>
        </div>
        @error('nip_nim_nik')
        <div class="invalid-feedback">
            <small>{{ $message }}</small>
        </div>
        @enderror

        <div class="form-floating mb-2">
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required
                value="{{ old('status') }}">
                <option selected>--- Pilih ---</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Dosen">Dosen</option>
                <option value="Tendik">Tendik</option>
                <option value="Masyarakat Umum">Masyarakat Umum</option>
            </select>
            <label for="status">Status</label>
        </div>
        @error('status')
        <div class="invalid-feedback">
            <small>{{ $message }}</small>
        </div>
        @enderror

    </div>
    <div class="col-lg-4">
        <div class="form-floating mb-2">
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                placeholder="Masukkan tempat lahir" name="tempat_lahir" required value="{{ old('tempat_lahir') }}">
            <label for="tempat_lahir">Tempat lahir</label>
        </div>
        @error('tempat_lahir')
        <div class="invalid-feedback">
            <small>{{ $message }}</small>
        </div>
        @enderror

        <div class="form-floating mb-2">
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                placeholder="Masukkan tanggal lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
            <label for="tanggal_lahir">Tanggal lahir</label>
        </div>
        @error('tanggal_lahir')
        <div class="invalid-feedback">
            <small>{{ $message }}</small>
        </div>
        @enderror
    </div>

    <div class="col-lg-4">
        <div class="form-floating mb-2">
            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                name="jenis_kelamin" required value="{{ old('jenis_kelamin') }}">
                <option selected>--- Pilih ---</option>
                <option value="Laki-Laki">Laki - Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="jenis_kelamin">Jenis Kelamin</label>
        </div>
        @error('jenis_kelamin')
        <div class="invalid-feedback">
            <small>{{ $message }}</small>
        </div>
        @enderror

        <div class="form-floating mb-2">
            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon"
                placeholder="Maasukkan nomor telepon..." name="nomor_telepon" required
                value="{{ old('nomor_telepon') }}">
            <label for="nomor_telepon">Nomor Telepon/WA</label>
        </div>
        @error('nomor_telepon')
        <div class="invalid-feedback">
            <small>{{ $message }}</small>
        </div>
        @enderror
    </div>
</div>
<div class="col-lg-12">
    <div class="form-floating mb-2">
        <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap"
            id="alamat" name="alamat" required style="height: 100px">{{ old('alamat') }}</textarea>
        <label for="alamat">Alamat Lengkap</label>
    </div>
</div>