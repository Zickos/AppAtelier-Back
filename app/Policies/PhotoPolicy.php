<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PhotoPolicy
{
    const ADMIN = 'Admin';
    const MECANICIEN = 'Mécanicien';
    const SUPERVISEUR = 'Superviseur';

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Photo $photo): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::MECANICIEN, self::SUPERVISEUR]);
    }

    public function update(User $user, Photo $photo): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::MECANICIEN, self::SUPERVISEUR]);
    }

    public function delete(User $user, Photo $photo): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::SUPERVISEUR]);
    }
}
