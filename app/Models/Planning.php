<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    /** @use HasFactory<\Database\Factories\PlanningFactory> */
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_plannings')
            ->withTimestamps();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function retrofit()
    {
        return $this->belongsTo(Retrofit::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'date',
        'date_debut',
        'date_fin',
        'commentaire',
        'etat',
        'vehicle_id',
        'retrofit_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'jour_debut_formatted',
        'jour_fin_formatted',
        'heure_debut_formatted',
        'heure_fin_formatted',
        'etat_formatted',
    ];
    /**
     * Get the attributes that should be cast.
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'date_debut' => 'date',
            'date_fin' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'etat' => 'boolean',
        ];
    }

    public function getJourDebutFormattedAttribute()
    {
        return $this->date_debut?->format('d/m/Y');
    }

    public function getJourFinFormattedAttribute()
    {
        return $this->date_fin?->format('d/m/Y');
    }

    public function getHeureDebutFormattedAttribute()
    {
        return $this->date_debut?->format('H:i');
    }

    public function getHeureFinFormattedAttribute()
    {
        return $this->date_fin?->format('H:i');
    }

    public function getEtatFormattedAttribute()
    {
        return $this->etat ? 'Terminé' : 'En cours';
    }
}
