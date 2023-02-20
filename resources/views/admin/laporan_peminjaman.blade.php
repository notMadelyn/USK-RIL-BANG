@extends('layouts.admin-layout')

@section('content-admin')
    <div class="card">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            <h3>Laporan Peminjaman</h3>
            <div class="d-flex gap-3">
                <button type="button" class="btn btn-icon btn-outline-success block" data-bs-toggle="modal"
                    data-bs-target="#excelModal">
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                </button>
                <button type="button" class="btn btn-icon btn-outline-danger block" data-bs-toggle="modal"
                    data-bs-target="#pdfModal">
                    <i class="bi bi-file-pdf-fill"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table align-middle" id="table1">
                <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Judul Buku</th>
                        <th class="text-center">Tanggal Peminjaman</th>
                        <th class="text-center">Tanggal Pengembalian</th>
                        <th class="text-center">Kondisi Buku Saat Dipinjam</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $key => $data)
                        <tr>
                            <td class="text-bold-500 text-center">{{ $data->user->fullname }}</td>
                            <td class="text-center">{{ $data->buku->judul }}</td>
                            <td class="text-center">{{ $data->tanggal_peminjaman }}</td>
                            @if ($data->tanggal_pengembalian)
                                <td class="text-center">{{ $data->tanggal_pengembalian }}</td>
                            @else
                                <td class="text-center">-</td>
                            @endif
                            <td class="text-center text-capitalize">
                                {{ $data->kondisi_buku_saat_dipinjam }}</td>
                            <td class="text-center">
                                @if ($data->done === 1)
                                    <span class="badge bg-success">Sudah Dikembalikan</span>
                                @else
                                    <span class="badge bg-warning text-black">Belum Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PDF Modal --}}
        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.peminjaman_pdf') }}" class="form-group" enctype="multipart/form-data"
                        method="post">
                        @method('post')
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalTitle">
                                Export PDF Peminjaman
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="card-body row">
                                <div class="col-md-3">
                                    <label for="tanggal_peminjaman">Tanggal</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" for type="date" name="tanggal_peminjaman">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button class="btn btn-primary ml-1">
                                <span class="text-dark">Export</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- EXcel Modal --}}
        <div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="excelModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.peminjaman_excel') }}" class="form-group" enctype="multipart/form-data"
                        method="post">
                        @method('post')
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="excelModalTitle">
                                Export Excel Peminjaman
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="card-body row">
                                <div class="col-md-3">
                                    <label for="tanggal_peminjaman">Tanggal</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" for type="date" name="tanggal_peminjaman">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button class="btn btn-primary ml-1">
                                <span class="text-dark">Export</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection
