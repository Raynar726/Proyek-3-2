<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class RoleManagementService
{
    public function changeRole(User $actor, User $target, string $newRole): void
    {
        if ($actor->is($target) || $target->role === 'admin') {
            throw ValidationException::withMessages([
                'role' => 'Akun admin tidak dapat diubah di fitur ini.'
            ]);
        }

        if ($target->role === $newRole) return;

        $target->role = $newRole;
        $target->save();
    }
}