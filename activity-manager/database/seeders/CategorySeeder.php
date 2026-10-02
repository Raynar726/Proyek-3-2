<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
        \App\Models\Category::create(['name' => 'Workshop', 'slug' => 'workshop']);
        \App\Models\Category::create(['name' => 'Pelatihan', 'slug' => 'pelatihan']);
    }
}
