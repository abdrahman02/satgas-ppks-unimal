@extends('frontend.layout.main')
@section('content')
<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="/">Beranda</a></li>
        <li>Profil</li>
        <li>Struktur Organisasi</li>
      </ol>
      <h2>Struktur Organisasi</h2>
    </div>
  </section>
  <!-- End Breadcrumbs -->

  <section class="struktur-pengurus">
    <div class="container">

      {{-- Periode --}}
      <form class="form-control" action="" method="get">
        <div class="input-group">
          <select class="form-select" id="periode" name="periode">
            <option selected>Pilih Periode</option>
            @foreach ($periodes as $item)
            @if (old('periode') == $item->id)
            <option value="{{ $item->id }}" selected>{{ $item->masa_periode }}</option>
            @else
            <option value="{{ $item->id }}">{{ $item->masa_periode }}</option>
            @endif
            @endforeach
          </select>
          <button class="btn btn-outline-info" type="submit"><i class="bi bi-arrow-right-circle"></i></button>
        </div>
      </form>

      <h2>Struktur Pengurus SATGAS PPKS UNIMAL Periode {{ $periode->masa_periode }}</h2>
      <hr>


      {{-- Kelompokkan pengurus berdasarkan level jabatan --}}
      @php
      $groupedPengurus = $pengurus->groupBy('level');
      @endphp

      {{-- Tampilkan pengurus sesuai dengan kelompoknya --}}
      @foreach($groupedPengurus as $level => $pengurusPerLevel)
      <div class="row">
        @foreach($pengurusPerLevel as $item)
        <div class="col-lg-3 text-center mx-auto mb-3">
          @if (!empty($item->image) )
          <img src="{{ asset('storage/struktur-organisasi/' . $item->image) }}" class="img-fluid" style="height: 250px">
          @else
          <img src="{{ asset('img/default-profile.jpg') }}" class="img-fluid rounded-pill" style="height: 250px">
          @endif
          <div class="deskripsi mt-2">
            <p class="text-poppins nama">{{ $item->nama_pengurus }}</p>
            <p class="text-poppins">{{ $item->jabatan->nama_jabatan }}</p>
            <p class="text-poppins">{{ $item->latar_belakang }}</p>
          </div>
        </div>
        @endforeach
      </div>
      @endforeach
      <hr>
    </div>
  </section>
</main>
<!-- End #main -->
@endsection

@push('custom-style')
<style>
  .struktur-pengurus h2 {
    color: #25B97C;
    font-weight: 700;
    text-align: center;
    margin: 20px 0;
  }

  .struktur-pengurus .deskripsi .nama {
    color: #25B97C;
    font-weight: 600;
  }

  .struktur-pengurus .deskripsi {
    font-weight: 400;
    line-height: 5px;
  }
</style>
@endpush