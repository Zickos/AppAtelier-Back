<?php

namespace App\Policies;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DemandePolicy
{
    const ADMIN = 'Admin';
    const TECHNICIEN = 'Technicien';

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Demande $demande): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::TECHNICIEN]);
    }

    public function update(User $user, Demande $demande): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::TECHNICIEN]);
    }

    public function delete(User $user, Demande $demande): bool
    {
        return $user->role?->name === self::ADMIN;
    }
}
