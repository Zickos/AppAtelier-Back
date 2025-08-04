<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    // 🔁 Relations

    public function retrofits()
    {
        return $this->hasMany(Retrofit::class);
    }

    public function typeVehicle()
    {
        return $this->belongsTo(TypeVehicle::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    // ✅ Champs assignables
    protected $fillable = [
        'id_client',
        'owner',
        'num_serie',
        'type_vehicle_id',
        'name',
        'marque',
    ];

    // 🙈 Masquer les timestamps si inutiles
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // 🧠 Casts pour les champs datés
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // 🔡 MUTATOR → Formatage de l'owner (Nom Propre)
    protected function owner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    // 🔠 ACCESSOR → Renvoie un identifiant combiné unique
    public function getFullIdAttribute(): string
    {
        return strtoupper($this->id_client . '-' . $this->num_serie);
    }

    // 🔍 SCOPE → Filtrer par propriétaire
    public function scopeOwnedBy($query, string $owner)
    {
        return $query->where('owner', $owner);
    }

    // 🧩 SCOPE → Filtrer par type de véhicule
    public function scopeOfType($query, int $typeId)
    {
        return $query->where('type_vehicle_id', $typeId);
    }
}
