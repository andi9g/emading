@extends('layout2.layout')


@section("title", "Data Pengguna")

@section("activePengguna", "active-sidebar")

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tabel Data Pengguna</h5>
        <div class="row my-3">
            <div class="col-md-8">
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#tambahadmin'>
                    Tambah Admin (Baru)
                </button>
                <div class='modal fade' id='tambahadmin' tabindex='-1' style='display: none;' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title'>Tambah Admin (Baru)</h5>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="{{ route('pengguna.store', []) }}" method="POST">
                            @csrf
                            <div class='modal-body'>
                                 <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" class="form-control" type="text" name="name" placeholder="masukan nama lengkap">
                                 </div>

                                 <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" class="form-control" type="text" name="username" placeholder="masukan username">
                                 </div>

                                 <div class='form-group'>
                                     <label for='foremail' class='text-capitalize'>Email</label>
                                     <input type='email' name='email' id='foremail' class='form-control' placeholder='masukan email'>
                                 </div>

                                 <div class='form-group'>
                                     <label for='forposisi' class='text-capitalize'>Posisi</label>
                                     <select name='posisi' id='forposisi' class='form-control'>
                                         <option value='admin'>admin</option>
                                         <option value='superadmin'>superadmin</option>
                                     <select>
                                 </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-success'>Tambah</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
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

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th width="5px">No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration + $data->firstItem() - 1  }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->posisi }}</td>
                            <td nowrap>
                                <form action='{{ route('pengguna.destroy', [$item->iduser]) }}' method='post' class='d-inline'>
                                     @csrf
                                     @method('DELETE')
                                     <button type='submit' class='badge bg-danger badge-btn border-0' onclick="return confirm('Yakin ingin dihapus?')">
                                         <i class="bi bi-trash"></i> Hapus
                                     </button>
                                </form>
                                <button type='button' class='badge bg-primary badge-btn border-0' data-bs-toggle='modal' data-bs-target='#editpengguna{{ $item->iduser }}'>
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <form action='{{ route('pengguna.reset', [$item->iduser]) }}' method='post' class='d-inline'>
                                     @csrf
                                     <button type='submit' class='badge bg-warning badge-btn border-0 text-dark' onclick="return confirm('Yakin ingin direset?')">
                                         <i class="bi bi-key"></i> Reset
                                     </button>
                                </form>

                            </td>
                        </tr>
                        <div class='modal fade' id='editpengguna{{ $item->iduser }}' tabindex='-1' style='display: none;' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                      <h5 class='modal-title'><i class="bi bi-pencil"> Edit Pengguna</i></h5>
                                      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <form action="{{ route('pengguna.update', [$item->iduser]) }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <div class='modal-body'>
                                            <div class="form-group">
                                               <label for="name">Nama Lengkap</label>
                                               <input id="name" class="form-control" type="text" value="{{ $item->name }}" name="name" placeholder="masukan nama lengkap">
                                            </div>

                                            <div class="form-group">
                                               <label for="username">Username</label>
                                               <input id="username" class="form-control" type="text" value="{{ $item->username }}" name="username" placeholder="masukan username">
                                            </div>

                                            <div class='form-group'>
                                                <label for='foremail' class='text-capitalize'>Email</label>
                                                <input type='email' value="{{ $item->email }}" name='email' id='foremail' class='form-control' placeholder='masukan email'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='forposisi' class='text-capitalize'>Posisi</label>
                                                <select name='posisi' id='forposisi' class='form-control'>
                                                    <option value='admin' @if ($item->posisi == "admin")
                                                        selected
                                                    @endif>admin</option>
                                                    <option value='superadmin' @if ($item->posisi == "superadmin")
                                                        selected
                                                    @endif>superadmin</option>
                                                <select>
                                            </div>
                                       </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            <button type='submit' class='btn btn-success'>Edit</button>
                                        </div>

                                    </form>
                              </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
