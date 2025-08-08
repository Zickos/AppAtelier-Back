<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VehicleSociete;

class VehicleSocietePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // tout le monde peut voir la liste
    }

    public function view(User $user, VehicleSociete $vehicle): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role?->name, ['Admin', 'Superviseur']);
    }

    public function update(User $user, VehicleSociete $vehicle): bool
    {
        logger('ROLE UPDATE ATTEMPT: ' . $user->role?->name); // 👈
        return in_array($user->role?->name, ['Admin', 'Superviseur']);
    }

    public function delete(User $user, VehicleSociete $vehicle): bool
    {
        return in_array($user->role?->name, ['Admin', 'Superviseur']);
    }
}
