<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type'          => 'categories',
            'id'            => $this->id,
            'attributes'    => [
                'name'        => $this->name ?? '',
                'slug'        => $this->slug,
                'category_id' => $this->category_id,
                'parent'      => is_null($this->category_id) ?: $this->category?->name
            ],
            'relationships' => [
                'parent_category'  => new CategoryResource($this->whenLoaded('category')),
                'child_categories' => CategoryResource::collection($this->whenLoaded('categories')),
                'posts'            => PostResource::collection($this->whenLoaded('posts')),
            ],
            'includes'      => [],
            'links'         => [
                'self' => route('v1:categories.show', ['category' => $this->id])
            ]
        ];
    }
}
