<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'kode' => 'ENS',
            'nama' => 'Ensiklopedia'
        ]);

        Kategori::create([
            'kode' => 'HRR',
            'nama' => 'Horor'
        ]);

        Kategori::create([
            'kode' => 'CP',
            'nama' => 'Cerpen'
        ]);

        Kategori::create([
            'kode' => 'UM',
            'nama' => 'Umum'
        ]);

        Kategori::create([
            'kode' => 'SJ',
            'nama' => 'Sejarah'
        ]);
    }
}
