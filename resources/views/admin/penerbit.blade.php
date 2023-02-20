@extends('layouts.admin-layout')

@section('content-admin')
    <div class="card">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            <h3>Data Penerbit</h3>
            <button type="button" class="btn btn-icon btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#storeModal">
                <i class="bi bi-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <table class="table align-middle" id="table1">
                <thead>
                    <tr>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penerbits as $penerbit)
                        <tr>
                            <td class="text-center">{{ $penerbit->kode }}</td>
                            <td class="text-center">{{ $penerbit->nama }}</td>
                            <td class="text-center">
                                @if ($penerbit->verif === 'verified')
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-warning text-black">Unverified</span>
                                @endif
                            </td>
                            <td>
                                <div class="buttons gap-2 d-flex justify-content-center">
                                    <button type="button" class="btn m-0 btn-icon btn-primary block" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $penerbit->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="post" action="{{ route('admin.hapus_penerbit', $penerbit->id) }}">
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="storeModalTitle">
                            Tambah Kategori
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.submit_penerbit') }}" method="POST" class="form-group">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="kode" placeholder="Kode" value=""
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="nama" placeholder="Nama" value=""
                                        class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" value="unverified" name="verif"
                                            id="btnradio1" autocomplete="off" checked>
                                        <label class="btn btn-outline-warning" for="btnradio1">Unverified</label>

                                        <input type="radio" class="btn-check" value="verified" name="verif"
                                            id="btnradio2" autocomplete="off">
                                        <label class="btn btn-outline-success" for="btnradio2">Verified</label>
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
                            <button class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Update Modal --}}
        @foreach ($penerbits as $penerbit)
            <div class="modal fade" id="updateModal{{ $penerbit->id }}" tabindex="-1" role="dialog"
                aria-labelledby="updateModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalTitle">
                                Update Kategori
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.update_penerbit', $penerbit->id) }}" method="post"
                            class="form-group">
                            @method('put')
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="text" name="kode" placeholder="Kode"
                                            value="{{ $penerbit->kode }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="nama" placeholder="Nama"
                                            value="{{ $penerbit->nama }}" class="form-control" required>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn-group" role="group"
                                            aria-label="Basic radio toggle button group">
                                            @if ($penerbit->verif == 'verified')
                                                <input type="radio" class="btn-check" value="verified" checked
                                                    name="verif" id="btnradio2" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnradio2">Verified</label>
                                            @else
                                                <input type="radio" class="btn-check" value="verified" name="verif"
                                                    id="btnradio2" autocomplete="off">
                                                <label class="btn btn-outline-success" for="btnradio2">Verified</label>
                                            @endif

                                            @if ($penerbit->verif == 'unverified')
                                                <input type="radio" class="btn-check" value="unverified"
                                                    name="verif" id="btnradio1" autocomplete="off" checked>
                                                <label class="btn btn-outline-warning" for="btnradio1">Unverified</label>
                                            @else
                                                <input type="radio" class="btn-check" value="unverified"
                                                    name="verif" id="btnradio1" autocomplete="off">
                                                <label class="btn btn-outline-warning" for="btnradio1">Unverified</label>
                                            @endif
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
                                <button class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Submit</span>
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
