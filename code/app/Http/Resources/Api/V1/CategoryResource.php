<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
//        return [
//            'name'        => $this->name ?? '',
//            'slug'        => $this->slug,
//            'category_id' => $this->category_id,
//            'parent'      => is_null($this->category_id) ?: $this->category?->name
//        ];


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
                'comments' => CommentResource::collection($this->whenLoaded('comments')),
                'author'   => new UserResource($this->whenLoaded('user')),
                'post'     => new CategoryResource($this->whenLoaded('post')),
            ],
            'includes'      => [],
            'links'         => [
                'self' => route('v1:comments.show', ['comment' => $this->id])
            ]
        ];
    }
}
