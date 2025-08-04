<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Voir la liste des utilisateurs
     */
    
    public function viewAny(User $user): bool
    {
        return $user->role?->name === 'Admin';
    }

    /**
     * Voir un utilisateur spécifique
     */

    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->role?->name === 'Admin';
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, User $model): bool
    {
        return false;
    }

    public function delete(User $user, User $model): bool
    {
        return false;
    }
}
