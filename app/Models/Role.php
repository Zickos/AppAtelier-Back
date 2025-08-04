<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    // 🔁 Relation : un rôle a plusieurs utilisateurs
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // ✅ Champs remplissables
    protected $fillable = [
        'name',
    ];

    // 🙈 Masquer les colonnes inutiles en API (si exposé)
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // 🧠 Champs formatés automatiquement
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
