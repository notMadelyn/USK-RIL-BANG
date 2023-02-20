@extends('layouts.user-layout')

@section('content-user')
    <div>
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-10">
                <h1>Buku yang sedang dipinjam</h1>
            </div>
            <div class="col-2">
                <a href="{{ route('user.form_peminjaman') }}" class="btn btn-primary float">Pinjam</a>
            </div>
        </div>
        <div>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Judul Buku</th>
                        <th class="text-center">Tanggal Peminjaman</th>
                        <th class="text-center">Tanggal Pengembalian</th>
                        <th class="text-center">Kondisi Buku Saat Dipinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $key => $peminjaman)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $peminjaman->buku->judul }}</td>
                            <td class="text-center">{{ $peminjaman->tanggal_peminjaman }}</td>
                            <td class="text-center">{{ $peminjaman->tanggal_pengembalian }}</td>
                            <td class="text-center text-capitalize">{{ $peminjaman->kondisi_buku_saat_dipinjam }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
