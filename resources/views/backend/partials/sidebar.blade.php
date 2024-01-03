<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>

            @can('admin')
            <li>
                <a href="/dashboard" aria-expanded="false">
                    <i class="fa fa-bar-chart menu-icon"></i><span class="nav-text">Overview</span>
                </a>
            </li>
            @endcan

            @can('author')
            <li>
                <a href="{{ route('news.index') }}" aria-expanded="false">
                    <i class="fa fa-newspaper-o menu-icon"></i><span class="nav-text">Berita</span>
                </a>
            </li>
            @endcan

            @can('petugas')
            <li>
                <a href="{{ route('laporan.index') }}" aria-expanded="false">
                    <i class="fa fa-paper-plane-o menu-icon"></i><span class="nav-text">Pengaduan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kotak-saran.index') }}" aria-expanded="false">
                    <i class="fa-regular fa-comment menu-icon"></i><span class="nav-text">Kotak Saran</span>
                </a>
            </li>
            @endcan

            @can('pengguna')
            <li>
                <a href="{{ route('laporan.index') }}" aria-expanded="false">
                    <i class="fa fa-paper-plane-o menu-icon"></i><span class="nav-text">Pengaduan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kotak-saran.index') }}" aria-expanded="false">
                    <i class="fa-regular fa-comment menu-icon"></i><span class="nav-text">Kotak Saran</span>
                </a>
            </li>
            @endcan

            @can('author')
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-sitemap menu-icon"></i><span class="nav-text">Struktur Organisasi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/dashboard/periode">Periode</a></li>
                    <li><a href="/dashboard/jabatan">Jabatan</a></li>
                    <li><a href="/dashboard/pengurus">Pengurus</a></li>
                </ul>
            </li>
            @endcan

            @can('admin')
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-robot"></i><span class="nav-text">ChatBot</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/dashboard/tema">Tema Percakapan</a></li>
                    <li><a href="/dashboard/pertanyaan">Percakapan</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-users menu-icon"></i><span class="nav-text">Pengguna</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/dashboard/petugas">Petugas</a></li>
                    <li><a href="/dashboard/author">Author</a></li>
                    <li><a href="/dashboard/pengguna">Pengguna</a></li>
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>