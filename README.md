# Proyek 3 Modul 3

Aplikasi Manajemen Kegiatan berbasis web menggunakan framework Laravel, dikembangkan untuk memenuhi tugas Praktikum Modul 3. Aplikasi ini menerapkan operasi CRUD dengan pemisahan *business logic* pada Service Class dan validasi melalui Form Request.

## Spesifikasi Lingkungan (Environment)
Proyek ini dibangun dan diuji menggunakan:
* **PHP:** v8.5.10
* **Composer:** v2.10.3
* **Laravel:** v13.32.0

## Cara Instalasi dan Menjalankan Proyek
Ikuti langkah-langkah berikut untuk menjalankan proyek dari hasil *clone*:

1. Install Dependensi PHP
   ```bash
   composer install
   ```

2. Setup Konfigurasi Environment
   Salin file contoh konfigurasi menjadi file `.env` utama:
   ```bash
   cp .env.example .env
   ```

3. Generate Application Key
   ```bash
   php artisan key:generate
   ```

4. Jalankan Migrasi dan Seeding Database.
   Membangun struktur tabel SQLite dan mengisi data awal kegiatan secara otomatis:
   ```bash
   php artisan migrate --seed
   ```

5. Jalankan Development Server
   ```bash
   php artisan serve
   ```

## Rute Utama (Main Routes)
Setelah server berjalan, aplikasi dapat diakses melalui browser pada URL berikut:
* **Halaman Daftar Kegiatan:** `http://127.0.0.1:8000/activities`