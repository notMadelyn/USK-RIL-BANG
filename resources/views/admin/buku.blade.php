@extends('layouts.admin-layout')

@section('content-admin')
    <div class="card">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            <h3>Data Buku</h3>
            <button type="button" class="btn btn-icon btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#storeModal">
                <i class="bi bi-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <table class="table align-middle" id="table1">
                <thead>
                    <tr>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Penerbit</th>
                        <th class="text-center">Tahun Terbit</th>
                        <th class="text-center">ISBN</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Pengarang</th>
                        <th class="text-center" style="min-width: 100px">Jumlah Buku Baik</th>
                        <th class="text-center" style="min-width: 110px">Jumlah Buku Rusak</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td class="text-center">{{ $buku->judul }}</td>
                            <td class="text-center">{{ $buku->kategori->nama }}</td>
                            <td class="text-center">{{ $buku->penerbit->nama }}</td>
                            <td class="text-center">{{ $buku->tahun_terbit }}</td>
                            <td class="text-center">{{ $buku->isbn }}</td>
                            <td class="text-center">
                                @if ($buku->photo)
                                    <img src="{{ asset($buku->photo) }}" alt="{{ $buku->judul }}" width="100px"
                                        height="100px">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">{{ $buku->pengarang }}</td>
                            <td class="text-center">{{ $buku->j_buku_baik }}</td>
                            <td class="text-center">{{ $buku->j_buku_buruk }}</td>
                            <td>
                                <div class="buttons gap-0 d-flex justify-content-center">
                                    <button type="button" class="btn m-0 btn-icon btn-primary block" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $buku->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="post" action="{{ route('admin.hapus_buku', $buku->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn m-0 btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Store Modal --}}
        <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="storeModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.submit_buku') }}" enctype="multipart/form-data" method="POST"
                        class="form-group">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            <h5 class="modal-title" id="storeModalTitle">
                                Tambah Buku
                            </h5>
                            <button class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="judul" placeholder="Judul" value=""
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="pengarang" placeholder="Pengarang" value=""
                                        class="form-control" required>
                                </div>
                                <div class="d-flex mb-3 gap-5 justify-content-center">
                                    <div>
                                        <select name="kategori_id" required style="width: 140px" class="form-select">
                                            <option disabled selected>Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}"
                                                    {{ isset($kategori_id) ? ($kategori_id == $kategori->id ? 'selected' : '') : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <select name="penerbit_id" required style="width: 140px" class="form-select">
                                            <option disabled selected>Penerbit</option>
                                            @foreach ($penerbits as $penerbit)
                                                <option value="{{ $penerbit->id }}"
                                                    {{ isset($penerbit_id) ? ($penerbit_id == $penerbit->id ? 'selected' : '') : '' }}>
                                                    {{ $penerbit->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex mb-3 gap-5 justify-content-center">
                                    <div>
                                        <input type="number" min="0" max="5000" style="width: 150px"
                                            placeholder="Tahun Terbit" name="tahun_terbit" value=""
                                            class="form-control" required>
                                    </div>
                                    <div>
                                        <input type="number" name="isbn" style="width: 150px" placeholder="ISBN"
                                            value="" class="form-control">
                                    </div>
                                </div>
                                <div class="d-flex mb-3 gap-5 justify-content-center">
                                    <div>
                                        <input type="number" min="0" max="5000" style="width: 180px"
                                            placeholder="Jumlah Buku Baik" name="j_buku_baik" value=""
                                            class="form-control" required>
                                    </div>
                                    <div>
                                        <input type="number" name="j_buku_buruk" style="width: 180px"
                                            placeholder="Jumlah Buku Rusak" value="" class="form-control" required>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 justify-content-between">
                                    <div>
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" value="" class="mt-3 form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Update Modal --}}
        @foreach ($bukus as $buku)
            <div class="modal fade" id="updateModal{{ $buku->id }}" tabindex="-1" role="dialog"
                aria-labelledby="updateModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.update_buku', $buku->id) }}" enctype="multipart/form-data"
                            method="post" class="form-group">
                            @method('put')
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                                <h5 class="modal-title" id="updateModalTitle">
                                    Update Buku
                                </h5>
                                <button class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="text" name="judul" placeholder="Judul"
                                            value="{{ $buku->judul }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="pengarang" placeholder="Pengarang"
                                            value="{{ $buku->pengarang }}" class="form-control" required>
                                    </div>
                                    <div class="d-flex mb-3 gap-2 justify-content-between">
                                        <div>
                                            <select name="kategori_id" required class="form-select">
                                                <option disabled selected>Kategori</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}"
                                                        {{ isset($kategori_id) ? ($kategori_id == $kategori->id ? 'selected' : '') : '' }}>
                                                        {{ $kategori->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <select name="penerbit_id" required class="form-select">
                                                <option disabled selected>Penerbit</option>
                                                @foreach ($penerbits as $penerbit)
                                                    <option value="{{ $penerbit->id }}"
                                                        {{ isset($penerbit_id) ? ($penerbit_id == $penerbit->id ? 'selected' : '') : '' }}>
                                                        {{ $penerbit->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3 gap-2 justify-content-between">
                                        <div>
                                            <input type="number" min="0" max="5000" style="width: 150px"
                                                placeholder="Tahun Terbit" name="tahun_terbit"
                                                value="{{ $buku->tahun_terbit }}" class="form-control" required>
                                        </div>
                                        <div>
                                            <input type="number" name="isbn" placeholder="ISBN" style="width: 150px"
                                                value="{{ $buku->isbn }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 gap-2 justify-content-between">
                                        <div>
                                            <input type="number" min="0" max="5000" style="width: 180px"
                                                placeholder="Jumlah Buku Baik" name="j_buku_baik"
                                                value="{{ $buku->j_buku_baik }}" class="form-control" required>
                                        </div>
                                        <div>
                                            <input type="number" name="j_buku_buruk" style="width: 180px"
                                                placeholder="Jumlah Buku Rusak" value="{{ $buku->j_buku_buruk }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-between">
                                        <div>
                                            @if ($buku->photo)
                                                <img src="{{ $buku->photo }}" alt="{{ $buku->judul }}">
                                            @else
                                                <label for="photo">Photo</label>
                                            @endif
                                            <input type="file" name="photo" value=""
                                                class="form-control mt-3">
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection
