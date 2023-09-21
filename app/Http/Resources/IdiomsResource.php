<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdiomsResource extends JsonResource
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
            'text' => $this->text,
            'transwordId' => $this->transword_id,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdAt' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updatedAt' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'transword' => $this->transword,
        ];
    }
}
