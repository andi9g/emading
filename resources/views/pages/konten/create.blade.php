@extends('layout2.layout')

@section('title', 'Tambah Konten NEW')

@section('activeKonten', 'active-sidebar')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Tambah Data Konten</h5>
            </div>
            <form action="{{ route('konten.store', []) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class='form-group'>
                        <label for='forjudul' class='text-capitalize'>Judul Konten <font class="text-danger">*</font></label>
                        <input type='text' name='judul' id='forjudul' class='form-control' placeholder='masukan judul konten' value="{{ old('judul') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class='form-group'>
                                <label for='fortanggal' class='text-capitalize'>Tanggal</label>
                                <input type='text' name='tanggal' id='fortanggal' class='form-control' value='{{ !empty(old("tanggal"))?old("tanggal"):date("Y-m-d") }}'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for='gambar' class='text-capitalize '>Gambar Konten</label>
                                <input class="form-control" type="file" name="gambar" placeholder="Recipient's file" aria-label="Recipient's file" aria-describedby="gambar">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tags</label>
                        <select class="js-example-basic-multi" name="tags[]" style="width:100%" multiple="multiple">
                            @if (!empty(old('tags')))
                            @foreach (old('tags') as $item)
                                <option value="{{ $item }}" selected>{{ $item }}</option>
                            @endforeach
                            @endif
                        </select>


                    </div>

                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea class="form-control" name="konten" rows="20" cols="100">{{old('konten')}}</textarea>
                    </div>
                </div>
                <div class="card-body text-right" style="text-align: right">
                    <button type="submit" class="btn btn-success">POSTING</button>
                </div>
            </form>
        </div>

    </div>
</div>


@endsection


@section('js')


<!-- jQuery Tags Input -->
<script src="{{ url('ckeditor/jquery.tagsinput/src/jquery.tagsinput.js', []) }}"></script>
<script src="{{ url('ckeditor/ckeditor/ckeditor.js', []) }}"></script>
<script>
    CKEDITOR.replace('konten',{
    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',

    language:'en-gb'
    });

    CKEDITOR.config.allowedContent = true;
</script>



<script>
$(document).ready(function() {
    // Inisialisasi Select2 dengan fitur tagging
    $('.js-example-basic-multi').select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
});
</script>


@endsection
