<?php

namespace App\Policies;

use App\Models\Planning;
use App\Models\User;

class PlanningPolicy
{
    const ADMIN = 'Admin';
    const TECHNICIEN = 'Technicien';

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Planning $planning): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role?->name, [self::ADMIN]);
    }

    public function update(User $user, Planning $planning): bool
    {
        return in_array($user->role?->name, [self::ADMIN]);
    }

    public function delete(User $user, Planning $planning): bool
    {
        return $user->role?->name === self::ADMIN;
    }
}
