<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function register(Activity $activity, array $data)
    {
        // Aturan 1: Hanya activity published
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages(['status' => 'Pendaftaran ditolak: Kegiatan belum dipublikasikan.']);
        }

        // Aturan 2: Ditolak jika start_at sudah lewat
        if ($activity->start_at && now()->greaterThan($activity->start_at)) {
            throw ValidationException::withMessages(['start_at' => 'Pendaftaran ditolak: Waktu kegiatan sudah terlewat.']);
        }

        // Aturan 3: Pengecekan email ganda
        if ($activity->registrations()->where('email', $data['email'])->exists()) {
            throw ValidationException::withMessages(['email' => 'Email ini sudah terdaftar pada kegiatan ini.']);
        }

        // Aturan 4: Kapasitas penuh
        if ($activity->registered_count >= $activity->capacity) {
            throw ValidationException::withMessages(['capacity' => 'Pendaftaran ditolak: Kuota sudah penuh.']);
        }

        // Aturan 5 & 6: Atomic Transaction & Rollback terkontrol
        return DB::transaction(function () use ($activity, $data) {
            // 1. Simpan data registrasi
            $registration = $activity->registrations()->create([
                'name' => $data['name'],
                'email' => $data['email']
            ]);

            // 2. Update jumlah pendaftar
            $activity->increment('registered_count');

            return $registration;
        });
    }
}