@extends('layout2.client.umum')

@section('title', "{{ $baca->judul }}")

@section('content')
<main class="main" id="hero">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">

      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ url('/', []) }}">Halaman Utama</a></li>
            <li class="current">Baca Mading</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container">

        <div class="row gy-5">



            <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <h2>{{$baca->judul}}</h2>
                <p>
                    <small class="badge bg-primary">
                        <i class="bi bi-clock"> </i>
                        {{ Carbon\Carbon::parse($baca->tanggal)->isoFormat('dddd, DD MMMM Y') }}
                    </small> |
                    <small class="badge bg-primary">
                        <i class="bi bi-pencil"></i> {{ $baca->user->name }}
                    </small>
                </p>
                <img src="{{ url('gambar/konten', [$baca->gambar]) }}" alt="" class="img-fluid services-img" style="box-shadow: 2px 1px 2px 2px rgba(126, 126, 126, 0.678)">



                <div class="konten">
                    <?php
                        echo strip_tags(htmlspecialchars_decode($baca->konten),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>');
                    ?>
                </div>

                <br>
                <p class="my-0 py-0 text-bold d-inline" style="font-weight: bold">Tags : </p>
                @php
                    $tags = explode(",",$baca->tags);
                @endphp

                @foreach ($tags as $tag)
                    <button class="badge badge-btn bg-success border-0">{{ $tag }}</button>
                @endforeach

            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                <div class="card">
                    <div class="card-header">
                        <h3>e{{ empty($pengaturan->namawebsite)?'':$pengaturan->namawebsite }}</h3>
                    </div>
                    <div class="card-body">
                        {{ empty($pengaturan->deskripsi)?'':$pengaturan->deskripsi }}
                    </div>
                </div>



                <div
                    class="help-box d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ url('gambar/logo', [empty($pengaturan->logo)?'':$pengaturan->logo]) }}" width="30%" class="help-icon" alt="">
                    <h4>SMKN 1 Gunung Kijang</h4>

                </div>

            </div>

        </div>

        <div class="row gy-5">
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
                        <div class="card product-card">
                            <img src="{{ url('gambar/konten', [$item->gambar]) }}" alt="Product Image" >
                            <div class="card-body">
                                <h5 class="product-title" class="btnku ">
                                    <a href="{{ route('baca.konten', [$item->idkonten]) }}" class="">
                                        {{ $item->judul }}
                                    </a>
                                </h5>
                                <p class="product-description my-0 py-0">
                                    <?php
                                       echo substr((strip_tags(htmlspecialchars_decode($item->konten),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>')), 0, 120);
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
        </div>

      </div>

    </section><!-- /Service Details Section -->

  </main>
@endsection
