<?php

namespace App\DTO\Api\V1;

readonly class CommentDTO
{
    public function __construct(public string $body, public int $post_id, public null|int $comment_id)
    {
    }

    public function toArray(): array
    {
        return [
            'body'        => $this->body,
            'post_id'     => $this->post_id,
            'comment_id'  => $this->comment_id,
        ];
    }
}
