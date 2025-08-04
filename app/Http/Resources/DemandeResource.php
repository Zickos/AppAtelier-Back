<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeResource extends JsonResource
{
    public function toArray(Request $request): array
{
    return [
        'id'              => $this->id,
        'user'            => new UserResource($this->whenLoaded('user')),
        'commentaire'     => $this->commentaire,
        'etat'            => $this->etat,
        'type'            => $this->type,
        'etat_formatted'  => $this->etat_formatted,
        'date'            => $this->date_formatted,
        'created_at'      => $this->created_at_human,
        'retrofit'        => new RetrofitResource($this->whenLoaded('retrofit')),
    ];
}

}
