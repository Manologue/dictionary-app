<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeyWordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'word' => $this->word,
            'slug' => $this->slug,
            'active' => $this->active,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdAt' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updatedAt' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'transwords' => $this->transwords,
        ];
    }
}
