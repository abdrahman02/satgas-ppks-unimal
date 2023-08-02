@extends('backend.layout.main-pengaduan-form')

@section('content')
<div class="row justify-content-center mt-0">
    <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
        <div class="card px-0 pt-4 pb-0 mt-3 mb-3 shadow-lg">
            <div class="d-flex flex-row justify-content-center">
                <img src="{{ asset('img/Logo-Tut-Wuri-Handayani.png') }}" alt="logo tut wuri handayani"
                    style="width: 100px;">
                <img src="{{ asset('img/logo_unimal_1.png') }}" alt="logo tut wuri handayani" style="width: 100px;">
                <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="logo tut wuri handayani"
                    style="width: 100px;">
            </div>

            <div class="row">
                <div class="col-md-12 mx-0">
                    <form id="msform" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

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

                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="informasi"><strong>Informasi</strong></li>
                            <li id="identitas_diri"><strong>Identitas Diri</strong></li>
                            <li id="identitas_pelaku"><strong>Identitas_pelaku</strong></li>
                            <li id="kejadian"><strong>Kejadian</strong></li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <h2 class="fs-title">LAYANAN PENGADUAN KEKERASAN SEKSUAL UNIVERSITAS MALIKUSSALEH</h2>
                                <span><strong>Kekerasan seksual merupakan salah satu tindakan yang harus kita cegah dan
                                        tangani bersama, mari laporkan dan percayakan semua tindakan kekerasan seksual
                                        yang Anda alami di kawasan Universitas Malikussaleh kepada kami.</strong></span>
                                <br>
                                <span><strong>Dasar Hukum:</strong></span>
                                <ol>
                                    <li>
                                        Surat Keputusan Rektor Universitas Malikussaleh No. 599/UN45/KPT/2022
                                    </li>
                                    <li>
                                        Undang-Undang Nomor 7 Tahun 1984 Tentang Pengesahan Konveksi mengenai
                                        Penghapusan Segala Bentuk Diskriminasi terhadap Wanita (Convention on the
                                        Elimination of All Forms of Discrimination Against Women) (Lembaran Negara
                                        Republik Indonesia Tahun 1999 Nomor 165,Tambahan Lembaran Negara Republik
                                        Indonesia Nomor
                                        3886);
                                    </li>
                                    <li>
                                        Undang-Undang Nomor 39 Tahun 1999 Tentang Hak Asasi Manusia (Lembaran Negara
                                        Republik Indonesia Tahun 2003Nomor 78, Tambahan Lembaran Negara Republik
                                        Indonesia Nomor 4301);
                                    </li>
                                    <li>
                                        Undang-Undang Nomor 12 Tahun 2012 Tentang Pendidikan Tinggi (Lembaran Negara
                                        Republik Indonesia Tahun 2012 Nomor 158, Tambahan Lembaran Negara Republik
                                        Indonesia Nomor 5336);
                                    </li>
                                    <li>
                                        Peraturan Pemerintah Nomor 4 Tahun 2014 Tentang Penyelenggaraan Pendidikan
                                        Tinggi dan Pengelolaan Perguruan Tinggi (Lembaran Negara Republik Indonesia
                                        Tahun 2014 Nomor 16 Tambahan Lembaran Negara Republik Indonesia Nomor 5500);
                                    </li>
                                    <li>
                                        Peraturan Menteri Pendidikan dan Kebudayaan Nomor 3 Tahun 2020 Tentang Standar
                                        Nasional Pendidikan Tinggi;
                                    </li>
                                    <li>
                                        Peraturan Menteri Pendidikan, Riset, dan Teknologi Nomor 30 Tahun 2021 Tentang
                                        Pencegahan dan Penanganan Kekerasan Seksual di Lingkungan Perguruan Tinggi;
                                    </li>
                                </ol>
                            </div>
                            <input type="button" class="back-action-button" value="Back" id="btn-kembali" />
                            <input type="button" name="next" class="next action-button" value="Next Step" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <h2 class="fs-title">Identitas Diri</h2>
                                <label for="prodi">Prodi</label>
                                <input type="text" id="prodi" name="prodi" placeholder="Program studi" autofocus />
                                <label for="fakultas">Fakultas</label>
                                <input type="text" id="fakultas" name="fakultas" placeholder="Fakultas" />
                                <label for="memiliki_disabilitas">Memiliki Disabilitas<span>*</span></label>
                                <input type="text" id="memiliki_disabilitas" name="memiliki_disabilitas"
                                    placeholder="Ya/Tidak" required />
                                <span class="text-warning"><i class="fa fa-info-circle"></i>&nbsp;Besar kecil huruf
                                    berpengaruh</span>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next Step" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <h2 class="fs-title">Identitas Pelaku</h2>
                                <label for="nama_pelaku">Nama Pelaku (Jika Mengetahui)</label>
                                <input type="text" id="nama_pelaku" name="nama_pelaku" placeholder="Nama pelaku" />
                                <label for="status_pelaku">Status_pelaku<span>*</span></label>
                                <select name="status_pelaku" id="status_pelaku" class="form-select" required>
                                    <option value="" selected>-- PILIH --</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                    <option value="Masyarakat Umum">Masyarakat Umum</option>
                                </select>
                                <label for="nim_nip_nik_pelaku">NIM/NIP/NIK Pelaku (Jika Ada)</label>
                                <input type="text" id="nim_nip_nik_pelaku" name="nim_nip_nik_pelaku"
                                    placeholder="NIM/NIP/NIK Pelaku" />
                                <label for="asal_instansi_pelaku">Asal Instansi (Prodi/Fakultas), "Jika Pelaku adalah lingkup
                                    Universitas"</label>
                                <input type="text" id="asal_instansi_pelaku" name="asal_instansi_pelaku"
                                    placeholder="Asal Instansi" />
                                <label for="kontak_pelaku">Kontak lain dari pelaku dapat berupa No. HP, akun media
                                    sosial dll (Jika Ada)</label>
                                <input type="text" id="kontak_pelaku" name="kontak_pelaku"
                                    placeholder="Kontak pelaku" />
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="make_payment" class="next action-button" value="Next" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <h2 class="fs-title">Kejadian</h2>
                                <label for="kronologi_kejadian">Ceritakan kronologi kekerasan yang Anda alami, setelah
                                    ini pihak kami akan menghubungi agar lebih jelasnya.<span>*</span></label>
                                <textarea name="kronologi_kejadian" id="kronologi_kejadian" class="form-control"
                                    placeholder="Ceritakan Kejadian" cols="5" rows="5" required></textarea>
                                <label for="waktu_kejadian">Waktu Kejadian<span>*</span></label>
                                <input type="date" id="waktu_kejadian" name="waktu_kejadian"
                                    placeholder="Waktu Kejadian" required />
                                <label for="bukti" class="form-label">Bukti<span>*</span></label>
                                <input class="form-control" type="file" id="bukti" name="bukti" required>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <button type="submit" class="submit-action-button">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('custom-script')
{{-- Membuat tombol kembali dari input --}}
<script>
    $(document).ready(function() {
      // Fungsi untuk mengarahkan ke halaman tujuan ketika tombol di klik
      $('#btn-kembali').click(function() {
        window.location.href = '{{ route("laporan.index") }}';
      });
    });
</script>
@endpush