<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'          => 'comments',
            'id'            => $this->id,
            'attributes'    => [
                'body'        => $this->when(
                                    $request->routeIs('v1:comments.show'),
                                    $this->body),
                'author_id'   => $this->user_id,
                'post_id'     => $this->post_id,
                'confirmed'   => $this->confirmed,
                'parent'      => $this->comment_id
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
