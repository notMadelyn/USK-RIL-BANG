<?php

namespace Database\Seeders;

use App\Models\Pesan;
use Illuminate\Database\Seeder;

class PesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pesan::create([
            'penerima_id' => 1,
            'pengirim_id' => 2,
            'judul' => 'Pesan Pengumuman',
            'isi' => 'Tes pesan pertama',
            'status' => 'dibaca',
            'tanggal_kirim' => '2023-01-06'
        ]);

        Pesan::create([
            'penerima_id' => 2,
            'pengirim_id' => 1,
            'judul' => 'Pesan Pengumuman 2',
            'isi' => 'Tes pesan kedua',
            'status' => 'terkirim',
            'tanggal_kirim' => '2023-01-06'
        ]);
    }
}
