@extends('layouts.user-layout')

@section('content-user')
    @php
        function rupiah($angka)
        {
            $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
            return $hasil_rupiah;
        }
    @endphp

    <div>
        @if (session('status_pengembalian'))
            <div class="alert alert-{{ session('status_pengembalian') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-10">
                <h1>Data Pengembalian</h1>
            </div>
            <div class="col-2">
                <a href="{{ route('user.form_pengembalian') }}" class="btn btn-primary float">Kembalikan</a>
            </div>
        </div>
        <div>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Judul Buku</th>
                        <th class="text-center">Tanggal Peminjaman</th>
                        <th class="text-center">Tanggal Pengembalian</th>
                        <th class="text-center">Kondisi Buku Saat Dipinjam</th>
                        <th class="text-center">Kondisi Buku Saat Dikembalikan</th>
                        <th class="text-center">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $data->buku->judul }}</td>
                            <td class="text-center">{{ $data->tanggal_peminjaman }}</td>
                            <td class="text-center">{{ $data->tanggal_pengembalian }}</td>
                            <td class="text-capitalize text-center">{{ $data->kondisi_buku_saat_dipinjam }}</td>
                            <td class="text-capitalize text-center">{{ $data->kondisi_buku_saat_dikembalikan }}</td>
                            <td class="text-center">
                                @if ($data->denda)
                                    {{ rupiah($data->denda) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
