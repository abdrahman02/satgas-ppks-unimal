@extends('frontend.layout.main')
@section('content')
<main>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="/">Beranda</a></li>
                <li><a href="{{ route('berita.index') }}">Berita</a></li>
            </ol>
            <h2>Berita</h2>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries d-flex flex-wrap">

                    @if (!empty($beritas))
                    @foreach ($beritas as $item)
                    <div class="col-lg-6">
                        <article class="entry">

                            <div class="entry-img">
                                @if (!empty($item->image) )
                                <img src="{{ asset('storage/berita/' . $item->image) }}" class="img-fluid">
                                @else
                                <img src="{{ asset('img/no-image-info.jpg') }}" class="img-fluid">
                                @endif
                            </div>

                            <h3 class="entry-title">
                                <a href="{{ route('berita.show', $item->id) }}">{{ $item->judul_berita }}</a>
                            </h3>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i><span href="#">{{
                                            $item->user->name }}</span></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i><span>{{
                                            $item->created_at->diffForHumans() }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    {!! Str::words($item->body, 15) !!}
                                </p>
                                <div class="read-more">
                                    <a href="{{ route('berita.show', $item->id) }}">Read More</a>
                                </div>
                            </div>

                        </article>
                        <!-- End blog entry -->
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-primary text-center" role="alert">
                        Berita sedang diperbaharui oleh author!!
                    </div>
                    @endif

                    <div class="mx-auto">
                        {{ $beritas->links() }}
                    </div>

                </div>
                <!-- End blog entries list -->

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

                    </div>
                    <!-- End sidebar -->

                </div>
                <!-- End blog sidebar -->

            </div>

        </div>
    </section>
    <!-- End Blog Section -->

</main>
<!-- End #main -->
@endsection