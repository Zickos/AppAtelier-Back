<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RetrofitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'etat'            => $this->etat,
            'etat_formatted'  => $this->etat_formatted,
            'date'            => $this->date_formatted,
            'commentaire'     => $this->commentaire,
            'created_at'      => $this->created_at_human,
            'numero'          => $this->numero,
            'vehicle'         => new VehicleResource($this->whenLoaded('vehicle')),
            'types_travaux'   => TypeTravailResource::collection($this->whenLoaded('typesTravaux')),
            'demandes'        => DemandeResource::collection($this->whenLoaded('demandes')),
            'photos'          => PhotoResource::collection($this->whenLoaded('photo')),
            'plannings'       => PlanningResource::collection($this->whenLoaded('plannings')),
        ];
    }
}
