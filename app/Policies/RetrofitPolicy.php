<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Retrofit;

class RetrofitPolicy
{
    const ADMIN = 'Admin';
    const SUPERVISEUR = 'Superviseur';

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Retrofit $retrofit): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::SUPERVISEUR]);
    }

    public function update(User $user, Retrofit $retrofit): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::SUPERVISEUR]);
    }

    public function delete(User $user, Retrofit $retrofit): bool
    {
        return in_array($user->role?->name, [self::ADMIN, self::SUPERVISEUR]);
    }
}
