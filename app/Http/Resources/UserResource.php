<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'prenom'     => $this->prenom,
            /* 'email'      => $this->email, */
            'role'       => new RoleResource($this->whenLoaded('role')),
            'demandes'   => DemandeResource::collection($this->whenLoaded('demandes')),
            'plannings'  => PlanningResource::collection($this->whenLoaded('plannings')),
            'retrofits' => RetrofitResource::collection($this->whenLoaded('retrofits')),

        ];
    }
}
