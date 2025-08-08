<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSociete extends Model
{
    use HasFactory;

    protected $table = 'vehicle_societe';

    protected $fillable = [
        'name',
        'marque',
        'model',
        'immatriculation',
        'datemec',
        'usage',
        'site',
        'copiecg',
        'copieassurance',
        'affectation',
        'commentaire',
        'datect',
        'dateprochainct',
        'dateentretien',
        'dateprochainentretien',
    ];

    protected $casts = [
        'datemec' => 'date',
        'datect' => 'date',
        'dateprochainct' => 'date',
        'dateentretien' => 'date',
        'dateprochainentretien' => 'date',
    ];
}
