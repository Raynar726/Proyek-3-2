<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id_barang' => 'PC001',
                'nama_barang' => 'NVIDIA GeForce RTX 4060',
                'deskripsi' => 'GPU untuk gaming dan produktivitas.',
                'harga' => 4500000,
                'stok' => 5,
                'gambar' => 'rtx4060.jpg',
            ],
            [
                'id_barang' => 'PC002',
                'nama_barang' => 'AMD Ryzen 5 5600',
                'deskripsi' => 'Prosesor 6-core untuk PC gaming.',
                'harga' => 1650000,
                'stok' => 8,
                'gambar' => 'ryzen5600.jpg',
            ],
            [
                'id_barang' => 'PC003',
                'nama_barang' => 'Intel Core i5-12400F',
                'deskripsi' => 'Prosesor desktop untuk gaming.',
                'harga' => 1850000,
                'stok' => 6,
                'gambar' => 'i512400f.jpg',
            ],
            [
                'id_barang' => 'PC004',
                'nama_barang' => 'Kingston Fury Beast 16GB DDR4',
                'deskripsi' => 'RAM DDR4 untuk desktop.',
                'harga' => 450000,
                'stok' => 12,
                'gambar' => 'ram16gb.jpg',
            ],
            [
                'id_barang' => 'PC005',
                'nama_barang' => 'Samsung 990 EVO 1TB',
                'deskripsi' => 'SSD NVMe untuk penyimpanan cepat.',
                'harga' => 1350000,
                'stok' => 7,
                'gambar' => 'ssd1tb.jpg',
            ],
            [
                'id_barang' => 'PC006',
                'nama_barang' => 'MSI B550M PRO-VDH',
                'deskripsi' => 'Motherboard socket AM4.',
                'harga' => 1450000,
                'stok' => 4,
                'gambar' => 'msib550m.jpg',
            ],
            [
                'id_barang' => 'PC007',
                'nama_barang' => 'Corsair CV650 650W',
                'deskripsi' => 'Power supply untuk komputer desktop.',
                'harga' => 850000,
                'stok' => 9,
                'gambar' => 'psu650.jpg',
            ],
            [
                'id_barang' => 'PC008',
                'nama_barang' => 'DeepCool AK400',
                'deskripsi' => 'Air cooler untuk prosesor.',
                'harga' => 450000,
                'stok' => 10,
                'gambar' => 'ak400.jpg',
            ],
            [
                'id_barang' => 'PC009',
                'nama_barang' => 'NZXT H5 Flow',
                'deskripsi' => 'Casing PC dengan aliran udara baik.',
                'harga' => 1250000,
                'stok' => 3,
                'gambar' => 'nzxth5.jpg',
            ],
            [
                'id_barang' => 'PC010',
                'nama_barang' => 'WD Blue SN580 1TB',
                'deskripsi' => 'SSD NVMe untuk penyimpanan data.',
                'harga' => 2200000,
                'stok' => 0,
                'gambar' => 'sn580.jpg',
            ],
        ]);
    }
}