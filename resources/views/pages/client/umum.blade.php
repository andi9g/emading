@extends('layout2.client.umum ')

@section('title', 'E-Mading SMKN 1 Gunung Kijang')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-5">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
              <h2><span class="text-success">e</span>{{ empty($pengaturan->namawebsite)?"":$pengaturan->namawebsite }}</h2>
              <p>{{ empty($pengaturan->deskripsi)?"":$pengaturan->deskripsi }}</p>
              <div class="d-flex mb-2">
                <a href="#mading" class="btn-get-started">Mulai Membaca</a>
                {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
              </div>

            </div>
            <div class="col-lg-6 order-1 order-lg-2">
              <img src="assets2/img/hero-img.png" class="img-fluid" alt="">
            </div>
          </div>
        </div>



      </section><!-- /Hero Section -->


      <!-- mading Section -->
      <section id="mading" class="mading section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>mading</h2>
          <div><span>LIHAT </span> <span class="description-title">MADING</span></div>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row gy-4">
            @if ($konten->count() == 0)
                <h3 class="text-center mb-5">Data Tidak Ditemukan</h3>
            @endif
            @foreach ($konten as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card product-card h-100">
                    <img src="{{ url('gambar/konten', [$item->gambar]) }}" alt="Product Image" >
                    <div class="card-body">
                        <h5 class="product-title" class="btnku ">
                            <a href="{{ route('baca.konten', [$item->idkonten]) }}" class="">
                                {{ $item->judul }}
                            </a>
                            <small class="badge badge-primary"></small>
                        </h5>
                        <p class="product-description my-0 py-0">
                            <?php
                               echo substr((strip_tags(htmlspecialchars_decode($item->konten),'<p></p>')), 0, 120);
                            ?> . . . .
                        </p>
                        <p class="product-date">
                            {{ Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, DD MMMM Y') }}
                        </p>
                    </div>
                </div>
            </div>

            @endforeach



          </div>

          {{ $konten->links("vendor.pagination.bootstrap-4") }}

        </div>

      </section><!-- /mading Section -->
@endsection
