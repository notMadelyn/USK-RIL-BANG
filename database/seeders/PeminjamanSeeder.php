<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peminjaman::create([
            'user_id' => 1,
            'buku_id' => 1,
            'tanggal_peminjaman' => '2023-01-06',
            'tanggal_pengembalian' => null,
            'kondisi_buku_saat_dipinjam' => 'baik',
            'kondisi_buku_saat_dikembalikan' => null,
            'denda' => null
        ]);

        Peminjaman::create([
            'user_id' => 1,
            'buku_id' => 2,
            'tanggal_peminjaman' => '2023-01-08',
            'tanggal_pengembalian' => null,
            'kondisi_buku_saat_dipinjam' => 'baik',
            'kondisi_buku_saat_dikembalikan' => null,
            'denda' => null
        ]);

        Peminjaman::create([
            'user_id' => 1,
            'buku_id' => 2,
            'tanggal_peminjaman' => '2023-01-10',
            'tanggal_pengembalian' => '2023-01-18',
            'kondisi_buku_saat_dipinjam' => 'baik',
            'kondisi_buku_saat_dikembalikan' => 'buruk',
            'denda' => 50000,
            'done' => 1
        ]);
    }
}
