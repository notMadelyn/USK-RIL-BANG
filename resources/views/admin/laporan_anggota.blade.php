@extends('layouts.admin-layout')

@section('content-admin')
    @php
        function rupiah($angka)
        {
            $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
            return $hasil_rupiah;
        }
    @endphp
    <div class="card">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="card-header d-flex justify-content-between">
            <h3>Laporan Anggota</h3>
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
                        <th class="text-center">Kondisi Buku Saat Dikembalikan</th>
                        <th class="text-center">Denda</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                        <tr>
                            <td class="text-bold-500 text-center" style="min-width: 200px">{{ $data->user->fullname }}</td>
                            <td class="text-center" style="min-width: 150px">{{ $data->buku->judul }}</td>
                            <td class="text-center" style="min-width: 120px">{{ $data->tanggal_peminjaman }}</td>
                            @if ($data->tanggal_pengembalian)
                                <td class="text-center" style="min-width: 120px">{{ $data->tanggal_pengembalian }}</td>
                            @else
                                <td class="text-center" style="min-width: 120px">-</td>
                            @endif
                            <td class="text-center text-capitalize" style="min-width: 150px">
                                {{ $data->kondisi_buku_saat_dipinjam }}</td>
                            @if ($data->kondisi_buku_saat_dikembalikan)
                                <td class="text-center text-capitalize" style="min-width: 180px">
                                    @if ($data->kondisi_buku_saat_dikembalikan == 'buruk')
                                        rusak
                                    @else
                                        {{ $data->kondisi_buku_saat_dikembalikan }}
                                    @endif
                                </td>
                            @else
                                <td class="text-center" style="min-width: 180px">-</td>
                            @endif
                            @if ($data->denda)
                                <td class="text-center" style="min-width: 120px">{{ rupiah($data->denda) }}</td>
                            @else
                                <td class="text-center" style="min-width: 120px">-</td>
                            @endif
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
                    <form action="{{ route('admin.anggota_pdf') }}" class="form-group" enctype="multipart/form-data"
                        method="post">
                        @method('post')
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalTitle">
                                Export PDF Anggota
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="kategori_id">Anggota</label>
                                    <select name="user_id" required class="form-select">
                                        <option disabled selected>--Pilih Anggota--</option>
                                        @foreach ($anggotas as $anggota)
                                            <option value="{{ $anggota->id }}">
                                                {{ $anggota->fullname }} {{ $anggota->id }} /
                                                {{ $anggota->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" value="" name="done" id="btnradio2"
                                            autocomplete="off" checked>
                                        <label class="btn btn-outline-info" for="btnradio2">Semua</label>

                                        <input type="radio" class="btn-check" value="true" name="done" id="btnradio1"
                                            autocomplete="off">
                                        <label class="btn btn-outline-success" for="btnradio1">Sudah Dikembalikan</label>

                                        <input type="radio" class="btn-check" value="false" name="done" id="btnradio3"
                                            autocomplete="off">
                                        <label class="btn btn-outline-warning" for="btnradio3">Belum Dikembalikan</label>
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
                                <span class="text-dark">Export</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Excel Modal --}}
        <div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="excelModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.anggota_excel') }}" class="form-group" enctype="multipart/form-data"
                        method="post">
                        @method('post')
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="excelModalTitle">
                                Export Excel Anggota
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="user_id">Anggota</label>
                                    <select name="user_id" required class="form-select">
                                        <option disabled selected>--Pilih Opsi--</option>
                                        @foreach ($anggotas as $anggota)
                                            <option value="{{ $anggota->id }}">
                                                {{ $anggota->fullname }} {{ $anggota->id }} /
                                                {{ $anggota->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="">Status</label>
                                    <select name="done" required class="form-select">
                                        <option value="" disabled selected>--Pilih Opsi--</option>
                                        <option value="">Semua</option>
                                        <option value="false">Belum Dikembalikan</option>
                                        <option value="true">Sudah Dikembalikan</option>
                                    </select>
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
