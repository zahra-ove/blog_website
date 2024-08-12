<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'        => $this->name ?? '',
            'slug'        => $this->slug,
            'category_id' => $this->category_id,
            'parent'      => is_null($this->category_id) ?: $this->category?->name
        ];
    }
}
