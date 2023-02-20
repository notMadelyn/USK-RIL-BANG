@extends('layouts.user-layout')

@section('content-user')
    <?php
    $today = date('Y-m-d');
    ?>

    <div style="max-width: 40%">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengembalian</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('user.submit_pengembalian') }}" class="form-group" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Buku yang Dikembalikan</label>

                        <select name="buku_id" required class="form-select">
                            <option disabled selected>--Pilih Opsi--</option>
                            @foreach ($pengembalian->unique('buku_id') as $b)
                                <option value="{{ $b->buku->id }}"
                                    {{ isset($buku_id) ? ($buku_id == $b->buku->id ? 'selected' : '') : '' }}>
                                    {{ $b->buku->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Tanggal Pengembalian</label>
                        <input type="date" readonly name="tanggal_pengembalian" value="<?php echo $today; ?>"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Kondisi buku</label>
                        <select name="kondisi_buku_saat_dikembalikan" required class="form-select">
                            <option value="" disabled selected>--Pilih Opsi--</option>
                            <option value="baik">Baik</option>
                            <option value="buruk">Buruk</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
