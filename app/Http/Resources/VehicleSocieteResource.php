<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleSocieteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'marque' => $this->marque,
            'model' => $this->model,
            'immatriculation' => $this->immatriculation,
            'datemec' => $this->datemec?->format('Y-m-d'),
            'usage' => $this->usage,
            'site' => $this->site,
            'copiecg' => $this->copiecg,
            'copieassurance' => $this->copieassurance,
            'affectation' => $this->affectation,
            'commentaire' => $this->commentaire,
            'datect' => $this->datect?->format('Y-m-d'),
            'dateprochainct' => $this->dateprochainct?->format('Y-m-d'),
            'dateentretien' => $this->dateentretien?->format('Y-m-d'),
            'dateprochainentretien' => $this->dateprochainentretien?->format('Y-m-d'),
        ];
    }
}
