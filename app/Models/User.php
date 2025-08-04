<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function plannings()
    {
        return $this->belongsToMany(Planning::class, 'users_plannings')
            ->withTimestamps();
    }

    // ✅ Champs remplissables
    protected $fillable = [
        'prenom',
        'email',
        'password',
        'role_id',
    ];

    // 🙈 Champs à masquer (sensible)
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    // 🧠 Casts automatiques
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getRetrofitsAttribute(): Collection
    {
        // 1. Retrofits via les demandes (relation directe)
        $fromDemandes = $this->demandes()
            ->with('retrofit')
            ->get()
            ->pluck('retrofit')
            ->filter();

        // 2. Retrofits via les véhicules assignés dans les plannings
        $fromPlannings = $this->plannings()
            ->with('vehicle.retrofits')
            ->get()
            ->pluck('vehicle.retrofits')
            ->flatten()
            ->filter();

        // 3. Fusion et dédoublonnage
        return $fromDemandes
            ->merge($fromPlannings)
            ->unique('id')
            ->values();
    }
}
