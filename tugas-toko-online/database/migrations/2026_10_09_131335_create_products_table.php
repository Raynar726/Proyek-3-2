<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id_barang', 10)->primary();
            $table->string('nama_barang', 50);
            $table->text('deskripsi');
            $table->decimal('harga', 12, 2);
            $table->integer('stok')->default(0);
            $table->string('gambar', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
