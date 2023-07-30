@extends('frontend.layout.main')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="/">Beranda</a></li>
                <li><a href="{{ route('berita.index') }}">Berita</a></li>
                <li>Detail berita</li>
            </ol>
            <h2>Detail Berita</h2>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            @if (!empty($berita->image) )
                            <img src="{{ asset('storage/berita/' . $berita->image) }}" class="img-fluid">
                            @else
                            <img src="{{ asset('img/no-image-info.jpg') }}" class="img-fluid">
                            @endif
                        </div>

                        <h2 class="entry-title">
                            <span>{{ $berita->judul_berita }}</span>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <span href="#">{{
                                        $berita->user->name }}</span></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                    <span>{{ $berita->created_at->diffForHumans() }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            {!! $berita->body !!}
                        </div>

                    </article>
                    <!-- End blog entry -->

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Berita lainnya</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($otherNews as $item)
                            <div class="post-item clearfix">
                                @if (!empty($item->image) )
                                <img src="{{ asset('storage/berita/' . $item->image) }}">
                                @else
                                <img src="{{ asset('img/no-image-info.jpg') }}">
                                @endif
                                <h4><a href="{{ route('berita.show', $item->id) }}">{{ $item->judul_berita }}</a></h4>
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            @endforeach
                        </div>
                        <!-- End sidebar recent posts-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section>
    <!-- End Blog Single Section -->

</main><!-- End #main -->
@endsection