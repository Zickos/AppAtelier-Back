<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrofit extends Model
{
    /** @use HasFactory<\Database\Factories\RetrofitFactory> */
    use HasFactory;

    // 🔁 Relations

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function typesTravaux()
    {
        return $this->belongsToMany(TypeTravail::class, 'retrofits_types_travaux')
                    ->withTimestamps();
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    // ✅ Scopes personnalisés

    /**
     * Retrofit validé (etat = true)
     */
    public function scopeValidated($query)
    {
        return $query->where('etat', true);
    }

    /**
     * Retrofit en attente (etat = false)
     */
    public function scopePending($query)
    {
        return $query->where('etat', false);
    }

    // ✅ Champs remplissables
    protected $fillable = [
        'etat',
        'commentaire',
        'date',
        'vehicle_id',
        'numero',
    ];

    // 🙈 Masquer les timestamps techniques dans l’API
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // ✅ Champs virtuels à afficher
    protected $appends = [
        'etat_formatted',
        'date_formatted',
        'created_at_human',
    ];

    // 🔁 Casts automatiques (Carbon & boolean)
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'etat' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // 🧠 Accessors pour l’affichage lisible

    public function getEtatFormattedAttribute()
    {
        return $this->etat ? 'Terminé' : 'En Cours';
    }

    public function getDateFormattedAttribute()
    {
        return $this->date?->format('d/m/Y');
    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at?->diffForHumans();
    }
}
