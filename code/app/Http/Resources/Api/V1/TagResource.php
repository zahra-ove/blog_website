<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type'          => 'tags',
            'id'            => $this->id,
            'attributes'    => [
                'name'       => $this->name,
            ],
            'relationships' => [
                'posts' => PostResource::collection($this->whenLoaded('posts')),
            ],
            'includes'      => [],
            'links'         => [
                'self' => route('v1:tags.show', ['tag' => $this->id])
            ]
    ];
    }
}
