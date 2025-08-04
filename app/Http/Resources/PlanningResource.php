<?php

namespace App\Http\Resources;

use App\Models\Retrofit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanningResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'commentaire'            => $this->commentaire,
            'date_debut'             => $this->jour_debut_formatted,
            'date_fin'               => $this->jour_fin_formatted,
            'etat'                   => $this->etat,
            'etat_formatted'         => $this->etat_formatted,
            'jour_debut'             => $this->jour_debut_formatted,
            'jour_fin'               => $this->jour_fin_formatted,
            'heure_debut'            => $this->heure_debut_formatted,
            'heure_fin'              => $this->heure_fin_formatted,
            'vehicle'                => new VehicleResource($this->whenLoaded('vehicle')),
            'retrofit'                => new RetrofitResource($this->whenLoaded('retrofit')),
            'users'                  => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
