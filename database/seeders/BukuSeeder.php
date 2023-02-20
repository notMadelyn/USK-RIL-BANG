<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'judul' => 'Majalah BOBO',
            'kategori_id' => 2,
            'penerbit_id' => 2,
            'tahun_terbit' => '2012',
            'isbn' => '371263616',
            'photo' => '/img/bobo.jpg',
            'pengarang' => 'Robben Koresj',
            'j_buku_baik' => 10,
            'j_buku_buruk' => 3
        ]);

        Buku::create([
            'judul' => 'Bahasa Ibrani',
            'kategori_id' => 4,
            'penerbit_id' => 1,
            'tahun_terbit' => '2006',
            'isbn' => '9786012313032',
            'photo' => '/img/ibrani.jpg',
            'pengarang' => 'Cindy Aulia',
            'j_buku_baik' => 15,
            'j_buku_buruk' => 5
        ]);

        Buku::create([
            'judul' => 'Matematika',
            'kategori_id' => 4,
            'penerbit_id' => 1,
            'tahun_terbit' => '2006',
            'isbn' => '97860312313032',
            'photo' => '/img/mtk.jpg',
            'pengarang' => 'Zein',
            'j_buku_baik' => 21,
            'j_buku_buruk' => 5
        ]);

        Buku::create([
            'judul' => 'Fisika',
            'kategori_id' => 4,
            'penerbit_id' => 1,
            'tahun_terbit' => '2006',
            'isbn' => '9782312313032',
            'photo' => '/img/fisika.jpg',
            'pengarang' => 'Svenson',
            'j_buku_baik' => 21,
            'j_buku_buruk' => 5
        ]);

        Buku::create([
            'judul' => 'SEJARAH DUNIA', 
            'kategori_id' => 5,
            'penerbit_id' => 1,
            'tahun_terbit' => '2006',
            'isbn' => '9782339133032',
            'photo' => '/img/sejarah.jpg',
            'pengarang' => 'Peter',
            'j_buku_baik' => 17,
            'j_buku_buruk' => 6
        ]);
    }
}
