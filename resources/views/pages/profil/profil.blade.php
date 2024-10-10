@extends('layout2.layout')

@section("judul", "Profil")

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-lg text-bold">Gambar</div>
                </div>
                <div class="card-body text-center">
                    <img src="{{ url('gambar', [Auth::user()->gambar]) }}" width="80%" class="rounded-circle" alt="">
                </div>
                <div class="card-footer">
                    <form action="{{ route('ubah.gambar', []) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" type="file" name="gambar" placeholder="masukan gambar" aria-label="masukan gambar" aria-describedby="ubahgambar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success" id="ubahgambar">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">



            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">IDENTITAS</h5>

                  <!-- Default Tabs -->
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="namalengkap" data-bs-toggle="tab" data-bs-target="#IdentitasLengkap" type="button" role="tab" aria-controls="IdentitasLengkap" aria-selected="false" tabindex="-1">Identitas Lengkap</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="ubahpassword" data-bs-toggle="tab" data-bs-target="#UbahPassword" type="button" role="tab" aria-controls="UbahPassword" aria-selected="true">Ubah Password</button>
                    </li>
                  </ul>


                  <div class="tab-content pt-3" id="myTabContent">
                    <div class="tab-pane active show" id="IdentitasLengkap" role="tabpanel" aria-labelledby="namalengkap">
                        <form action="{{ route('ubah.nama', []) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" class="form-control" type="text" value="{{ Auth::user()->name }}" name="name">
                            </div>

                            <div class="text-right my-3">
                                <button type="submit" class="btn btn-success text-right">UPDATE</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane show " id="UbahPassword" role="tabpanel" aria-labelledby="ubahpassword">
                        <form action="{{ route('ubah.password', []) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input id="password" class="form-control @error('password')
                                    is-invalid
                                @enderror" type="password" name="password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password2">Ulangi Password</label>
                                <input id="password2" class="form-control @error('password2')
                                    is-invalid
                                @enderror" type="password" name="password2">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-right my-3">
                                <button type="submit" class="btn btn-success text-right">UPDATE</button>
                            </div>
                        </form>
                    </div>

                  </div><!-- End Default Tabs -->

                </div>
              </div>

        </div>
    </div>
</div>


@endsection
