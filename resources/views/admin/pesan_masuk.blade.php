@extends('layouts.admin-layout')

@section('content-admin')
    @if (session('status'))
        <div class="alert alert-{{ session('status') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-9">
            <h3>Pesan Masuk</h3>
            <p class="text-subtitle text-muted">Kirim Pesan Ke Admin</p>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pengirim</th>
                            <th>Judul Pesan</th>
                            <th>Isi Pesan</th>
                            <th>Status Pesan</th>
                            <th>Tanggal Kirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masuk as $key => $m)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $m->pengirim->fullname }}</td>
                                <td>{{ $m->judul }}</td>
                                <td style="max-width: 30rem">{{ $m->isi }}</td>
                                <td>{{ $m->status == 'terkirim' ? 'Belum Dibaca' : 'Terbaca' }}</td>
                                <td>{{ $m->tanggal_kirim }}</td>
                                <td>
                                    @if ($m->status == 'terkirim')
                                        <form action="{{ route('admin.ubah_status', ['id' => $m->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="penerima_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('admin.hapus_pesan', $m->id) }}">
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
