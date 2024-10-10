@extends('layout2.layout')

@section('title', 'Pengaturan')

@section('activePengaturan', 'active-sidebar')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form pengaturan</h5>
                </div>
                <form action="{{ route('pengaturan.store', []) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <center>
                            <img src="{{ url('gambar/logo', empty($data->logo)?'noimage.png':$data->logo) }}" width="100px" alt="">
                        </center>
                        <div class='form-group'>
                            <label for='fornamawebsite' class='text-capitalize'>Nama Website</label>
                            <input type='text' name='namawebsite' id='fornamawebsite' class='form-control' placeholder='masukan nama website' value="{{ empty($data->namawebsite)?'':$data->namawebsite }}">
                        </div>

                        <div class='form-group'>
                            <label for='fordeskripsi' class='text-capitalize'>Deskripsi Website</label>
                            <textarea name="deskripsi" id="" cols="30" rows="3" placeholder="masukan deskripsi website" class="form-control">{{ empty($data->deskripsi)?'':$data->deskripsi }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="logo">Masukan Gambar Logo</label>
                            <input id="logo" class="form-control-file form-control" type="file" name="logo">
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success">UPDATE</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
