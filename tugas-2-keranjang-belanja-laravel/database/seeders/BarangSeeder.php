<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            ['nama_barang' => 'Buku Tulis', 'harga' => 5000, 'stok' => 100],
            ['nama_barang' => 'Pensil', 'harga' => 2000, 'stok' => 200],
            ['nama_barang' => 'Penghapus', 'harga' => 1500, 'stok' => 150],
            ['nama_barang' => 'Pulpen', 'harga' => 3000, 'stok' => 120],
            ['nama_barang' => 'Penggaris', 'harga' => 2500, 'stok' => 80],
        ];
        Barang::insert($barangs);
    }
}
