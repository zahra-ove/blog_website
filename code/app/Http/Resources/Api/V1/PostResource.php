<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type'          => 'posts',
            'id'            => $this->id,
            'attributes'    => [
                'title'       => $this->title,
                'body'        => $this->when(
                                      $request->routeIs('v1:posts.show'),
                                      $this->body),
                'author_id'   => $this->author_id,
                'category_id' => $this->category_id,
            ],
            'relationships' => [
                'comments' => CommentResource::collection($this->whenLoaded('comments')),
                'author'   => new UserResource($this->whenLoaded('author')),
                'category' => new CategoryResource($this->whenLoaded('category')),
                'tags'     => TagResource::collection($this->whenLoaded('tags'))
            ],
            'includes'      => [],
            'links'         => [
                'self' => route('v1:posts.show', ['post' => $this->id])
            ]
        ];
    }
}
