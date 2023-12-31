<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'partition' => new PartitionResource($this->Partition),
            'category' => new CategoryResource($this->Category),
        ];
    }
}
