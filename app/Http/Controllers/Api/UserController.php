<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Liste tous les utilisateurs
     */
    public function index(UserRequest $request)
    {
        $users = User::with('role', 'demandes', 'plannings')->get();
        return UserResource::collection($users);
    }

    public function indexMecanicien(UserRequest $request)
    {
        $users = User::with(['role', 'demandes', 'plannings'])
            ->whereHas('role', function ($query) {
                $query->where('name', 'Mécanicien');
            })
            ->get();
        return UserResource::collection($users);
    }

    public function indexMagasinier(UserRequest $request)
    {
        $users = User::with(['role', 'demandes', 'plannings'])
            ->whereHas('role', function ($query) {
                $query->where('name', 'Magasinier');
            })
            ->get();

        return UserResource::collection($users);
    }


    public function indexUsers(UserRequest $request)
    {
        $users = User::with('role')->get();
        return UserResource::collection($users);
    }

    /**
     * Détail d’un utilisateur
     */
    public function show(UserRequest $request, User $user)
    {
        return new UserResource($user->load([
            'role',
            'demandes.retrofit.vehicle.typeVehicle',
            'plannings.retrofit',
            'plannings.vehicle.typeVehicle',
        ]));
    }

    /**
     * Création d’un utilisateur
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        return new UserResource($user->load('role'));
    }

    /**
     * Mise à jour d’un utilisateur
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return new UserResource($user->load('role'));
    }

    /**
     * Suppression d’un utilisateur
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
