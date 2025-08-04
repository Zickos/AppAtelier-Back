<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTravail extends Model
{
    /** @use HasFactory<\Database\Factories\TypeTravailFactory> */
    use HasFactory;

    // 🔁 Relation many-to-many avec Retrofit
    public function retrofits()
    {
        return $this->belongsToMany(Retrofit::class, 'retrofits_types_travaux')
                    ->withTimestamps();
    }

    // ✅ Champs remplissables
    protected $fillable = [
        'name',
    ];

    // 🙈 Champs masqués dans les réponses API (si exposé)
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // 🧠 Casts pour Carbon
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
