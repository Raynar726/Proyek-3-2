<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Belajar Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-02-24',
                'category' => 'Belajar',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modul 4',
                'description' => 'Mengerjakan Modul 4 Proyek.',
                'activity_date' => '2026-09-30',
                'category' => 'Tugas',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Setup Proyek Laravel 13',
                'description' => 'Mengerjakan Task 1 Modul 3.',
                'activity_date' => '2026-09-26',
                'category' => 'Tugas',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Belajar Bahasa Jepang',
                'description' => 'Persiapan ujian JLPT N4.',
                'activity_date' => '2026-12-01',
                'category' => 'Belajar',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modul 2',
                'description' => 'Mengerjakan Modul 2 Proyek',
                'activity_date' => '2026-06-15',
                'category' => 'Tugas',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}