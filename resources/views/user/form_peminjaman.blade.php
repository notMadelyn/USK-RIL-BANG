@extends('layouts.user-layout')

@section('content-user')
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $today = date('Y-m-d');
    ?>

    <div style="max-width: 40%">
        <div class="card">
            <div class="card-header">
                <h4>Form Peminjaman</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('user.submit_peminjaman') }}" class="form-group" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_peminjaman" value="<?php echo $today; ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="buku_id">Pilih Buku</label>

                        <select name="buku_id" required class="form-select">
                            <option disabled selected>--Pilih Opsi--</option>

                            @foreach ($bukus as $buku)
                                <option value="{{ $buku->id }}"
                                    {{ isset($buku_id) ? ($buku_id == $buku->id ? 'selected' : '') : '' }}>
                                    {{ $buku->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Kondisi buku</label>
                        <select name="kondisi_buku_saat_dipinjam" required class="form-select">
                            <option value="" disabled selected>--Pilih Opsi--</option>
                            <option value="baik">Baik</option>
                            <option value="buruk">Buruk</option>
                        </select>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
