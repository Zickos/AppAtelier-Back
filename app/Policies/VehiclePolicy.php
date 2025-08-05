<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;

class VehiclePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // tout le monde peut voir la liste
    }

    public function view(User $user, Vehicle $vehicle): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role?->name, ['Admin', 'Superviseur']);
    }

    public function update(User $user, Vehicle $vehicle): bool
    {
        return in_array($user->role?->name, ['Admin', 'Superviseur']);
    }

    public function delete(User $user, Vehicle $vehicle): bool
    {
                return in_array($user->role?->name, ['Admin', 'Superviseur']);

    }
}
