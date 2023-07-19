<header id="header" class="header fixed-top shadow-sm">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="/" class="logo d-flex align-items-center">
      <img src="{{ asset('img/Logo-Tut-Wuri-Handayani.png') }}" alt="logo tut wuri handayani">
      <img src="{{ asset('img/logo_unimal_1.png') }}" alt="logo tut wuri handayani">
      <img src="{{ asset('img/logo-satgas-ppks-unimal.png') }}" alt="logo tut wuri handayani">
      {{-- <span>FlexStart</span> --}}
    </a>

    <nav id="navbar" class="navbar">
      <ul>
        {{-- Beranda --}}
        <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}" href="/"><i
              class="bi bi-house-fill"></i>&nbsp;Beranda</a></li>

        {{-- Profil --}}
        <li class="dropdown"><a href="#"
            class="{{ Request::is('filosofi-logo*') ? 'active' : '' }} {{ Request::is('struktur-organisasi*') ? 'active' : '' }}"><i
              class="bi bi-person-lines-fill"></i>&nbsp;<span>Profil</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="/filosofi-logo" class="{{ Request::is('filosofi-logo*') ? 'active' : '' }}">Filosofi Logo</a>
            </li>
            <li><a href="/struktur-organisasi"
                class="{{ Request::is('struktur-organisasi*') ? 'active' : '' }}">Struktur Organisasi</a></li>
          </ul>
        </li>

        {{-- Kekerasan Seksual --}}
        <li class="dropdown"><a href="#"
            class="{{ Request::is('dasar-hukum*') ? 'active' : '' }} {{ Request::is('kekerasan-seksual*') ? 'active' : '' }}"><i
              class="bi bi-bank2"></i>&nbsp;<span>Kekerasan Seksual</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="/dasar-hukum" class="{{ Request::is('dasar-hukum*') ? 'active' : '' }}">Dasar Hukum</a></li>
            <li><a href="/kekerasan-seksual" class="{{ Request::is('kekerasan-seksual*') ? 'active' : '' }}">Kekerasan
                Seksual</a></li>
          </ul>
        </li>

        {{-- Berita --}}
        <li><a class="nav-link scrollto {{ Request::is('berita*') ? 'active' : '' }}" href="/berita"><i
              class="bi bi-newspaper"></i>&nbsp;Berita</a></li>

        {{-- Survei --}}
        <li class="dropdown"><a href="#" class=""><i class="bi bi-ui-checks"></i>&nbsp;<span>Kuesioner</span> <i
              class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a class="nav-link scrollto" href="#">Kotak Saran</a></li>
            <li><a class="nav-link scrollto" href="#">Survei</a></li>
          </ul>
        </li>
      </ul>

      <ul>
        {{-- Lapor! --}}
        <li><a class="getstarted scrollto" href="#"><i class="bi bi-send-exclamation-fill"></i>&nbsp;LAPOR !</a></li>
        {{-- Login --}}
        <li><a class="button-login scrollto" href="#"><i class="bi bi-box-arrow-in-right"></i>&nbsp;Login</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <!-- .navbar -->
  </div>
</header>