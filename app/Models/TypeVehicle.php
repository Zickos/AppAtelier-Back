<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    /** @use HasFactory<\Database\Factories\TypeVehicleFactory> */
    use HasFactory;

    // 🔁 Relation : un type de véhicule possède plusieurs véhicules
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    // ✅ Champs remplissables
    protected $fillable = [
        'name',
    ];

    // 🙈 Champs à masquer dans les réponses API (facultatif)
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // 🧠 Casts pour formats Carbon
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
