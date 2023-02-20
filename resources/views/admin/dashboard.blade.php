@extends('layouts.admin-layout')

@section('content-admin')
    @foreach ($pemberitahuans as $pemberitahuan)
        @if ($pemberitahuans->count() > 3)
            {{ null }}
        @else
            @if ($pemberitahuan->status == 'aktif')
                <div class="alert alert-primary col-12 d-flex justify-content-between" id="notif/{{ $pemberitahuan->id }}"
                    role="alert">
                    {{ $pemberitahuan->isi }}
                    <button type="button" class="btn btn-secondary" onclick="hide({{ $pemberitahuan->id }});">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @elseif ($pemberitahuan->status == 'admin')
                <div class="alert alert-info col-12 d-flex justify-content-between" id="notif/{{ $pemberitahuan->id }}"
                    role="alert">
                    {{ $pemberitahuan->isi }}
                    <button type="button" class="btn btn-secondary" onclick="hide({{ $pemberitahuan->id }});">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif
        @endif
    @endforeach
    @if ($pemberitahuans->count() > 3)
        <div class="alert alert-primary col-12 d-flex justify-content-between" id="notif/8" role="alert">
            Silahkan cek pemberitahuan
            <button type="button" class="btn btn-secondary" onclick="hide(8);">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    <div class="d-flex gap-3 justify-content-around">
        {{-- Anggota --}}
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">Anggota : {{ $anggota->count() }}</h4>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ route('admin.data-anggota') }}" class="btn btn-outline-primary">More Info <i
                        class="bi bi-arrow-right-square"></i></a>
            </div>
        </div>

        {{-- Buku --}}
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">Buku : {{ $buku->count() }}</h4>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ route('admin.buku') }}" class="btn btn-outline-primary">More Info <i
                        class="bi bi-arrow-right-square"></i></a>
            </div>
        </div>

        {{-- Peminjaman --}}
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">Peminjaman : {{ $peminjaman->count() }}</h4>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ route('admin.laporan_peminjaman') }}" class="btn btn-outline-primary">More Info
                    <i class="bi bi-arrow-right-square"></i></a>
            </div>
        </div>

        {{-- Pengembalian --}}
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">Pengembalian : {{ $pengembalian->count() }}</h4>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ route('admin.laporan_pengembalian') }}" class="btn btn-outline-primary">More
                    Info
                    <i class="bi bi-arrow-right-square"></i></a>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column justify-content-center align-items-center">
        @if ($identitas->photo)
            <img src="{{ asset($identitas->photo) }}" alt="img" width="150px" height="150px">
        @endif
        <h4 class="mt-3"> {{ $identitas->nama_app }}</h4>
        <div class="">
            Alamat: {{ $identitas->alamat_app }} | Email: {{ $identitas->email_app }} | No. Telp:
            {{ $identitas->nomor_hp }}
        </div>
    </div>

    <script>
        function hide(id) {
            let notif = document.getElementById(`notif/${id}`).classList;
            console.log(notif);
            notif.add("d-none");
        }
    </script>
@endsection
