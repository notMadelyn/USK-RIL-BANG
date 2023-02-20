@extends('layouts.admin-layout')

@section('content-admin')
    <div class="card">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            Data User
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
                        <th class="text-center">NIS</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Nama Pengguna</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Terakhir Login</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center" style="max-width: 120px">{{ $user->kode }}</td>
                            <td class="text-center">{{ $user->nis }}</td>
                            <td class="text-center" style="min-width: 150px">{{ $user->fullname }}</td>
                            <td class="text-center" style="min-width: 150px">{{ $user->username }}</td>
                            <td class="text-center" style="min-width: 100px">{{ $user->kelas }}</td>
                            <td class="text-center" style="min-width: 200px">
                                @if ($user->alamat)
                                    {{ $user->alamat }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($user->photo)
                                    <img src="{{ asset($user->photo) }}" style="height: 100px; width: 100px;"
                                        class="card-img" alt="{{ $user->username }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center" style="min-width: 150px">{{ $user->terakhir_login }}</td>
                            <td class="text-center">
                                @if ($user->verif === 'verified')
                                    <span class="badge bg-success">{{ $user->verif }}</span>
                                @else
                                    <span class="badge bg-warning text-black">{{ $user->verif }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="buttons gap-2 d-flex justify-content-center">
                                    @if ($user->verif == 'unverified')
                                        <form action="{{ route('admin.verif_user', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="penerima_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="btn m-0 btn-success">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" class="btn m-0 btn-icon btn-primary block" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $user->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="post" action="{{ route('admin.hapus_anggota', $user->id) }}">
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
                            Tambah Anggota
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.submit_anggota') }}" enctype="multipart/form-data" method="POST"
                        class="form-group">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="fullname" placeholder="Fullname" value=""
                                        class="form-control" required>
                                </div>
                                <div class="d-flex gap-5">
                                    <div class="mb-3">
                                        <input type="text" name="username" placeholder="Username" value=""
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" placeholder="Password" value=""
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="d-flex gap-5">
                                    <div class="mb-3">
                                        <input type="number" name="nis" placeholder="NIS" value=""
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="kelas" placeholder="Kelas" value=""
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="alamat" placeholder="Alamat" value=""
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" value="" class="mt-3 form-control">
                                </div>

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="kode" value="generate">
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
        @foreach ($users as $user)
            <div class="modal fade" id="updateModal{{ $user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="updateModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="storeModalTitle">
                                Update Anggota
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.update_anggota', $user->id) }}" enctype="multipart/form-data"
                            method="post" class="form-group">
                            @method('put')
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="text" name="fullname" placeholder="Fullname"
                                            value="{{ $user->fullname }}" class="form-control" required>
                                    </div>
                                    <div class="d-flex gap-5">
                                        <div class="mb-3">
                                            <input type="text" name="username" placeholder="Username"
                                                value="{{ $user->username }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" name="nis" placeholder="NIS"
                                                value="{{ $user->nis }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="d-flex gap-5">
                                        <div class="mb-3">
                                            <input type="text" name="kelas" placeholder="Kelas"
                                                value="{{ $user->kelas }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="alamat" placeholder="Alamat"
                                                value="{{ $user->alamat }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="">
                                        @if ($user->photo)
                                            <img src="{{ $user->photo }}" alt="{{ $user->username }}" width="100px"
                                                height="100px">
                                        @else
                                            <label for="">Foto</label>
                                        @endif
                                        <input type="file" name="photo" value="" class="mt-3 form-control">
                                    </div>
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
