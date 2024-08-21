<?php

namespace App\DTO\Api\V1;

readonly class CommentDTO
{
    public function __construct(string $body, null|int $user_id,
                                int $post_id, null|int $comment_id)
    {
    }
}
