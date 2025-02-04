<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BottleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullName' => $this->full_name,
            'name' => $this->name,
            'edition' => $this->edition,
            'category' => $this->category,
            'description' => $this->description,
            'flavorProfile' => $this->flavor_profile,
            'tastingNotes' => $this->tasting_notes,
            'statedAge' => $this->stated_age,
            'caskStrength' => $this->cask_strength,
            'singleCask' => $this->single_cask,
            'imageUrl' => $this->image_url ? config('app.url').$this->image_url : null,
            'vintageYear' => $this->vintage_year,
            'releaseYear' => $this->release_year,
            'caskType' => $this->cask_type,
            'caskFill' => $this->cask_fill,
            'caskSize' => $this->cask_size,
            'brand' => new EntityResource($this->brand),
            'distillers' => EntityResource::collection($this->distillers),
            'bottler' => $this->bottler ? new EntityResource($this->bottler) : null,
            'avgRating' => $this->avg_rating,
            'totalTastings' => $this->total_tastings,
            'suggestedTags' => $this->suggested_tags,
            'isFavorite' => $this->is_favorite,
            'hasTasted' => $this->has_tasted,
            'createdAt' => $this->created_at->toISOString(),
            'updatedAt' => $this->updated_at->toISOString(),
        ];
    }
}
