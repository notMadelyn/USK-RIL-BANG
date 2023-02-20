@extends('layouts.user-layout')

@section('content-user')
    @if (session('status'))
        <div class="alert alert-{{ session('status') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-9">
            <h3>Pesan Masuk</h3>
            {{-- <p class="text-subtitle text-muted">Kirim Pesan Ke Admin</p> --}}
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table align-middle" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Pengirim</th>
                            <th class="text-center">Judul Pesan</th>
                            <th class="text-center">Isi Pesan</th>
                            <th class="text-center">Status Pesan</th>
                            <th class="text-center">Tanggal Kirim</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masuk as $key => $m)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $m->pengirim->fullname }}</td>
                                <td>{{ $m->judul }}</td>
                                <td style="max-width: 30rem">{{ $m->isi }}</td>
                                <td class="text-center">{{ $m->status == 'terkirim' ? 'Belum Dibaca' : 'Terbaca' }}</td>
                                <td class="text-center">{{ $m->tanggal_kirim }}</td>
                                <td class="text-center">
                                    @if ($m->status == 'terkirim')
                                        <form action="{{ route('user.ubah_status', ['id' => $m->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="penerima_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('user.hapus_pesan', $m->id) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
