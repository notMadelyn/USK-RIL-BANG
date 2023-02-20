<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'kode' => 'das3217731aas33',
            'nis' => '581236113',
            'fullname' => 'Robben Ezackly Koresj',
            'username' => 'benzy',
            'password' => Hash::make('password'),
            'kelas' => '12 RPL',
            'alamat' => '',
            'photo' => '/img/monyet.jpg',
            'verif' => 'verified',
            'role' => 'user',
            'join_date' => '2023-01-06'
        ]);

        User::create([
            'kode' => 'ADMdfha0368gc6bal1d6',
            'nis' => '',
            'fullname' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'kelas' => '',
            'alamat' => '',
            'photo' => '/img/aning.jpg',
            'verif' => 'verified',
            'role' => 'admin',
            'join_date' => '2023-01-06'
        ]);
    }
}
