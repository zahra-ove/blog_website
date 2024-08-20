<?php

namespace App\DTO\Api\V1;

readonly class CommentDTO
{
    public function __construct(string $body, ?int $user_id,
                                int $post_id, ?int $comment_id)
    {
    }
}
