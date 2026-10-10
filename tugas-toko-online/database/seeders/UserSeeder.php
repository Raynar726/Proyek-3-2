<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_user'      => 'USR002',
                'nama_lengkap' => 'John Budi',
                'email'        => 'john@gmail.com',
                'username'     => 'john',
                'password'     => Hash::make('jobudi77'),
                'no_hp'        => '082134567890',
                'alamat'       => 'Bekasi, Jawa Barat',
            ],
            [
                'id_user'      => 'USR003',
                'nama_lengkap' => 'Riska Putri',
                'email'        => 'riska@gmail.com',
                'username'     => 'riska',
                'password'     => Hash::make('rika567'),
                'no_hp'        => '081234567888',
                'alamat'       => 'Jakarta, DKI Jakarta',
            ]
        ]);
    }
}