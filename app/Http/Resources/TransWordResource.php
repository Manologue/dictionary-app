<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransWordResource extends JsonResource
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
            'class' => $this->word,
            'vocal' => $this->word,
            'etymology' => $this->etymology,
            'sample' => $this->sample,
            'active' => $this->active,
            'keywordId' => $this->keyword_id,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdAt' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updatedAt' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'keyword' => $this->keyword,
            'idioms' => $this->idioms,
        ];
    }
}
