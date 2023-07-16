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
        <li class="dropdown"><a href="#" class="{{ Request::is('filosofi-logo*') ? 'active' : '' }}"><i
              class="bi bi-person-lines-fill"></i>&nbsp;<span>Profil</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="/filosofi-logo">Filosofi Logo</a></li>
            <li><a href="#">Struktur Organisasi</a></li>
          </ul>
        </li>

        {{-- Kekerasan Seksual --}}
        <li class="dropdown"><a href="#" class="{{ Request::is('dasar-hukum*') ? 'active' : '' }}"><i
              class="bi bi-bank2"></i>&nbsp;<span>Kekerasan Seksual</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="/dasar-hukum">Dasar Hukum</a></li>
            <li><a href="#">Kekerasan Seksual</a></li>
          </ul>
        </li>

        {{-- Berita --}}
        <li><a class="nav-link scrollto {{ Request::is('berita*') ? 'active' : '' }}" href="/berita"><i
              class="bi bi-newspaper"></i>&nbsp;Berita</a></li>

        {{-- Survei --}}
        <li><a class="nav-link scrollto" href="#"><i class="bi bi-ui-checks"></i>&nbsp;Survei</a></li>
      </ul>

      <ul>
        {{-- Lapor! --}}
        <li><a class="getstarted scrollto" href="#"><i class="bi bi-send-exclamation-fill"></i>&nbsp;LAPOR !</a>
        </li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <!-- .navbar -->
  </div>
</header>