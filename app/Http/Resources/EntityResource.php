<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'shortName' => $this->short_name,
            'type' => $this->type,
            'description' => $this->description,
            'yearEstablished' => $this->year_established,
            'website' => $this->website,
            'country' => $this->country ? new CountryResource($this->country) : null,
            'region' => $this->region ? new RegionResource($this->region) : null,
            'address' => $this->address,
            'location' => $this->location,
            'createdAt' => $this->created_at->toISOString(),
            'updatedAt' => $this->updated_at->toISOString(),
            'totalTastings' => $this->total_tastings,
            'totalBottles' => $this->total_bottles,
        ];
    }
}
