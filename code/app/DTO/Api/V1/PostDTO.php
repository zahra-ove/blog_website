<?php

namespace App\DTO\Api\V1;

use DateTime;

readonly class PostDTO
{
    public function __construct(string $title, null|string $body,
                                null|int $category_id, bool $publish, DateTime $publish_at)
    {
    }
}
