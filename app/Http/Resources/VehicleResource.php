<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'id_client'     => $this->id_client,
            'name'          => $this->name,
            'owner'         => $this->owner,
            'num_serie'     => $this->num_serie,
            'marque'     => $this->marque,
            'type' => new TypeVehicleResource($this->whenLoaded('typeVehicle')),
            'created_at'    => $this->created_at?->format('d/m/Y H:i'),
            'retrofits'     => RetrofitResource::collection($this->whenLoaded('retrofits')),
            'plannings'     => PlanningResource::collection($this->whenLoaded('plannings')),
        ];
    }
}
