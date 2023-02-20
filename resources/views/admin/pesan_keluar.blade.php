@extends('layouts.admin-layout')

@section('content-admin')
    @if (session('status'))
        <div class="alert alert-{{ session('status') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-9">
            <h3>Pesan Terkirim</h3>
            <p class="text-subtitle text-muted">Kirim Pesan</p>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn shadow btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bi bi-send"></i>
                    Kirim Pesan
                </button>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Penerima</th>
                            <th>Judul Pesan</th>
                            <th>Isi Pesan</th>
                            <th>Status Pesan</th>
                            <th>Tanggal Kirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesan as $key => $p)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $p->penerima->fullname }}</td>
                                <td>{{ $p->judul }}</td>
                                <td style="max-width: 30rem">{{ $p->isi }}</td>
                                <td>{{ $p->status == 'terkirim' ? 'Terkirim' : 'Dibaca' }}</td>
                                <td>{{ $p->tanggal_kirim }}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.hapus_pesan', $p->id) }}">
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
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action={{ route('admin.kirim_pesan') }} enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" name="pengirim_id" value="{{ Auth::user()->id }}">
                                </div>

                                <div class="mb-3">
                                    <label>Penerima</label>
                                    <select class="form-select" name="penerima_id" required>
                                        <option value="" disabled selected>--PILIH OPSI--</option>
                                        @foreach ($penerimas as $b)
                                            <option value="{{ $b->id }}">
                                                {{ $b->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Judul Pesan</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        placeholder="masukkan judul pesan" name="judul" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Pesan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isi" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Tanggal Kirim</label>
                                    <input type="date" class="form-control" id="formGroupExampleInput"
                                        placeholder="Nama Siswa" name="tanggal_kirim" readonly value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <input type="hidden" name="status" value="terkirim">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
