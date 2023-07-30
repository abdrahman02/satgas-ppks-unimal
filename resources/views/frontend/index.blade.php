@extends('frontend.layout.main')
@section('content')
<!-- ======= Hero Section ======= -->
<section class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Apa itu kekerasan seksual ?</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">#BicarakanKeberanian #PerjuangkanKeadilan
          #UnimalMerdekaDariKekerasan</h2>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="#sekilas-kekerasan-seksual"
              class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Lihat detail...</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" style="height: 400px" class="me-5" alt="">
      </div>
    </div>
  </div>

</section>
<!-- End Hero -->

<!-- ======= Sekila Berita Section ======= -->
<section id="sekilas-berita" class="sekilas-berita">
  <div class="container" data-aos="fade-up">
    <header class="section-header">
      <h2>Sekilas Berita</h2>
    </header>

    <div class="row mt-n5">
      @foreach ($beritas as $item)
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="box">
          @if (!empty($item->image) )
          <img src="{{ asset('storage/berita/' . $item->image) }}" class="img-fluid">
          @else
          <img src="{{ asset('img/no-image-info.jpg') }}" class="img-fluid">
          @endif
          <h3>{{ $item->judul_berita }}</h3>
          <p>
            {!! Str::words($item->body, 5) !!}
          </p>
        </div>
      </div>
      @endforeach
      <div class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="text-center text-lg-start">
          <a href="/berita"
            class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
            <span>Lebih banyak...</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Sekilas Berita Section -->

{{-- Video Materi --}}
<section id="video-materi" class="video-materi">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <header class="section-header mb-3">
        <h2>Materi</h2>
      </header>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/Jb2gJjeAwTA" title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen></iframe>
      </div>
      <div class="col-lg-6">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/uLobL__llZU" title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>
{{-- End Video Materi --}}

{{-- Sekilas Apa itu kekerasan seksual --}}
<section class="sekilas-kekerasan-seksual">
  <div class="container">
    <div class="row">
      <header class="section-header mb-3" id="sekilas-kekerasan-seksual">
        <h2>Sekilas Kekerasan Seksual</h2>
      </header>

      <div class="col-lg-6">
        <img src="{{ asset('img/hero-stop-kekerasan-seksual.png') }}" class="img-fluid">
      </div>
      <div class="col-lg-6">
        <h3><strong>Apa itu “Kekerasan Seksual”?</strong></h3>
        <p><strong>Kekerasan Seksual</strong> adalah setiap perbuatan</p>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex align-items-center">
            <div class="col-lg-1 me-3">
              <img src="{{ asset('img/icon-kekerasan-sesksual/icon-6.png') }}" class="img-fluid">
            </div>
            <div class="col-lg-11">
              <p>
                merendahkan, menghina, melecehkan, dan/atau menyerang tubuh, dan/atau fungsi reproduksi seseorang,
              </p>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <div class="col-lg-1 me-3">
              <img src="{{ asset('img/icon-kekerasan-sesksual/icon-8.png') }}" class="img-fluid">
            </div>
            <div class="col-lg-11">
              <p>
                karena ketimpangan relasi kuasa dan/atau gender,
              </p>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <div class="col-lg-1 me-3">
              <img src="{{ asset('img/icon-kekerasan-sesksual/icon-9.png') }}" class="img-fluid">
            </div>
            <div class="col-lg-11">
              <p>
                yang berakibat atau dapat berakibat penderitaan psikis dan/atau fisik termasuk yang mengganggu kesehatan
                reproduksi seseorang,
              </p>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <div class="col-lg-1 me-3">
              <img src="{{ asset('img/icon-kekerasan-sesksual/icon-10.png') }}" class="img-fluid">
            </div>
            <div class="col-lg-11">
              <p>
                dan hilang kesempatan melaksanakan pendidikan dengan aman dan optimal.
              </p>
            </div>
          </li>
        </ul>
        <div class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="text-center text-lg-start">
            <a href="/kekerasan-seksual"
              class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Lebih banyak...</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- End Sekilas Apa itu kekerasan seksual --}}

@endsection