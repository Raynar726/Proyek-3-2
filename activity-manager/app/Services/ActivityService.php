<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    private const TRANSITIONS = [
        'Planned' => ['Planned', 'Ongoing'],
        'Ongoing' => ['Ongoing', 'Done'],
        'Done' => ['Done'],
    ];

    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        $nextStatus = $data['status'] ?? $activity->status;
        $this->ensureValidTransition($activity->status, $nextStatus);
        $activity->update($data);
        
        return $activity->refresh();
    }

    private function ensureValidTransition(string $current, string $next): void 
    {
        $allowed = self::TRANSITIONS[$current] ?? [];
        if (! in_array($next, $allowed, true)) {
            throw new DomainException(
                "Transisi status ($current ke $next) tidak diizinkan."
            );
        }
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan draft yang dapat dipublikasikan.'
            ]);
        }

        if (empty($activity->description)) {
            throw ValidationException::withMessages([
                'status' => 'Gagal publish! Deskripsi kegiatan harus diisi terlebih dahulu.'
            ]);
        }

        $activity->update(['status' => 'published']);
        return $activity;
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan yang sudah dipublikasi yang bisa diselesaikan.'
            ]);
        }

        $activity->update(['status' => 'completed']);
        return $activity;
    }
}