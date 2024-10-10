@extends('layout2.layout')

@section('title', 'Data Konten')

@section('activeKonten', 'active-sidebar')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tabel Data Konten</h5>

            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('konten.create', []) }}" class="btn btn-primary">Tambah Data Konten</a>
                </div>
                <div class="col-md-4">
                    <form action="{{ url()->current() }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="keyword" value="{!! $keyword !!}" placeholder="kata kunci" aria-label="keyword" aria-describedby="keyword">
                            <div class="input-group-append">
                                <button class="input-group-text border-secondary btn-cari"   id="keyword">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5px">No</th>
                            <th>Judul</th>
                            <th>Tags</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->tags }}</td>
                                <td nowrap>
                                    <a href="{{ route('konten.edit', [$item->idkonten]) }}" class="badge bg-primary">
                                        <i class="bi bi-edit"></i> Edit
                                    </a>

                                    <form action='{{ route('konten.destroy', [$item->idkonten]) }}' method='post' class='d-inline'>
                                         @csrf
                                         @method('DELETE')
                                         <button type='submit' onclick="return confirm('Yakin ingin di hapus?')" class='badge bg-danger badge-btn border-0'>
                                             <i class="bi bi-trash"></i> Hapus
                                         </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
