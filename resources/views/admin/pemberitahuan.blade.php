@extends('layouts.admin-layout')

@section('content-admin')
    <div class="card">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            <h3>Pemberitahuan</h3>
            <button type="button" class="btn btn-icon btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#storeModal">
                <i class="bi bi-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Isi Pemberitahuan</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemberitahuans as $key => $pemberitahuan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td style="max-width: 38rem">{{ $pemberitahuan->isi }}</td>
                            <td>
                                @if ($pemberitahuan->status == 'aktif')
                                    <span class="badge bg-primary">General</span>
                                @elseif ($pemberitahuan->status == 'admin')
                                    <span class="badge bg-light text-black">Admin</span>
                                @elseif ($pemberitahuan->status == 'user')
                                    <span class="badge bg-success">User</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-around">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#activateModal{{ $pemberitahuan->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.nonactive_notif', ['id' => $pemberitahuan->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="bi bi-dash-circle"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.delete_notif', ['id' => $pemberitahuan->id]) }}"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
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
                            Buat Pemberitahuan
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.submit_pemberitahuan') }}" method="POST" class="form-group">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="mb-3">
                                    <textarea style="height: 100px" placeholder="Isi Pemberitahuan" type="text" name="isi" class="form-control" required></textarea>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" role="group"
                                        aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" value="aktif" name="status"
                                            id="btnradio1" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary" for="btnradio1">General</label>

                                        <input type="radio" class="btn-check" value="admin" name="status"
                                            id="btnradio2" autocomplete="off">
                                        <label class="btn btn-outline-light" for="btnradio2">Only Admin</label>

                                        <input type="radio" class="btn-check" value="user" name="status"
                                            id="btnradio3" autocomplete="off">
                                        <label class="btn btn-outline-success" for="btnradio3">Only User</label>
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

        {{-- Activate Modal --}}
        @foreach ($pemberitahuans as $pemberitahuan)
            <div class="modal fade" id="activateModal{{ $pemberitahuan->id }}" tabindex="-1" role="dialog"
                aria-labelledby="activateModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activateModalTitle">
                                Update Pemberitahuan
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.activate_notif', $pemberitahuan->id) }}" method="post"
                            class="form-group">
                            @method('put')
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <textarea style="height: 100px" placeholder="Isi Pemberitahuan" type="text" name="isi" value="{{ $pemberitahuan->isi }}"
                                            class="form-control" required>{{ $pemberitahuan->isi }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn-group" role="group"
                                            aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" value="aktif" name="status"
                                                id="btnradio1" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary" for="btnradio1">General</label>

                                            <input type="radio" class="btn-check" value="admin" name="status"
                                                id="btnradio2" autocomplete="off">
                                            <label class="btn btn-outline-light" for="btnradio2">Only Admin</label>

                                            <input type="radio" class="btn-check" value="user" name="status"
                                                id="btnradio3" autocomplete="off">
                                            <label class="btn btn-outline-success" for="btnradio3">Only User</label>
                                        </div>
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
