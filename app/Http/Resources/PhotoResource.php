<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'url'         => $this->url,
            'commentaire' => $this->commentaire,
            'retrofit' => new RetrofitResource($this->whenLoaded('retrofit')),
            'created_at'  => $this->created_at?->format('d/m/Y H:i'),
        ];
    }
}
