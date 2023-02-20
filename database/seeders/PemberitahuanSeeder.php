<?php

namespace Database\Seeders;

use App\Models\Pemberitahuan;
use Illuminate\Database\Seeder;

class PemberitahuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemberitahuan::create([
            'isi' => 'Pesan satu',
            'buku_id' => null,
            'kategori_id' => null,
            'level_user' => null,
            'status' => 'aktif'
        ]);

        Pemberitahuan::create([
            'isi' => 'Pesan dua',
            'level_user' => null,
            'buku_id' => null,
            'kategori_id' => null,
            'status' => 'nonaktif'
        ]);

        Pemberitahuan::create([
            'isi' => 'Perpustakaan akan tutup pada tanggal 28 Februari 2023',
            'level_user' => null,
            'buku_id' => null,
            'kategori_id' => null,
            'status' => 'user'
        ]);

        Pemberitahuan::create([
            'isi' => 'Dimohon untuk segera memverifikasi user yang baru mendaftar',
            'level_user' => null,
            'buku_id' => null,
            'kategori_id' => null,
            'status' => 'admin'
        ]);
    }
}
