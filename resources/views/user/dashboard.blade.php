@extends('layouts.user-layout')

@section('content-user')
    <div class="col-12">
        <div class="">
            @foreach ($pemberitahuans as $pemberitahuan)
                @if ($pemberitahuans->count() > 3)
                    {{ null }}
                @else
                    @if ($pemberitahuan->status == 'aktif')
                        <div class="alert alert-primary col-12 d-flex justify-content-between" id="notif/{{ $pemberitahuan->id }}" role="alert">
                            {{ $pemberitahuan->isi }}
                            <button type="button" class="btn btn-secondary" onclick="hide({{ $pemberitahuan->id }});">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @elseif ($pemberitahuan->status == 'user')
                        <div class="alert alert-info col-12 d-flex text-white justify-content-between" id="notif/{{ $pemberitahuan->id }}" role="alert">
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

            <div class="row">
                @foreach ($kategoris as $kategori)
                    @if ($kategori->bukus->count() < 1)
                        {{ null }}
                    @else
                        <div class="col-12 mt-5">
                            <h4>
                                <span class="badge bg-info text-black">{{ $kategori->nama }}</span>
                            </h4>
                            <div class="row d-flex flex-row flex-nowrap overflow-auto">
                                @foreach ($kategori->bukus as $buku)
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <img src="{{ asset($buku->photo) }}"
                                                    style="height: 150px;object-fit: cover;" class="card-img"
                                                    alt="{{ $buku->photo }}">
                                            </div>
                                            <div class="card-body">
                                                <h4 style="font-size: 24px; font-weight: bold">
                                                    {{ $buku->judul }}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="text-start">
                                                            {{ $buku->pengarang }}
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-end">{{ $buku->penerbit->nama }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <form method="POST"
                                                    action="{{ route('user.form_peminjaman_dashboard') }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $buku->id }}" name="buku_id">
                                                    <button class="btn btn-primary">
                                                        Pinjam
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
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
