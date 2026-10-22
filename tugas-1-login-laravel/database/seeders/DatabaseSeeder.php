<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'ahmad',
            'nama_lengkap' => 'Ahmad Fauzan',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'budi',
            'nama_lengkap' => 'Budi Santoso',
            'password' => Hash::make('budi1234'),
            'role' => 'customer',
        ]);

        User::create([
        'username' => 'citra',
        'nama_lengkap' => 'Citra Fitri',
        'password' => Hash::make('citra1234'),
        'role' => 'staff',
        ]);
    }
}
