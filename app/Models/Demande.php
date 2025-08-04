<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    /** @use HasFactory<\Database\Factories\DemandeFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function retrofit()
    {
        return $this->belongsTo(Retrofit::class); // si `retrofit_id` est la FK dans `demandes`
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'commentaire',
        'etat',
        'type'
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
        'etat_formatted',
        'date_formatted',
        'created_at_human',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getEtatFormattedAttribute()
    {
        return $this->etat ? 'Traitée' : 'En attente';
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
