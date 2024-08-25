<?php

namespace App\DTO\Api\V1;

use DateTime;

readonly class PostDTO
{
    public function __construct(public string $title, public null|string $body,
        public null|int $category_id, public bool $publish, public DateTime $publish_at)
    {
    }
}
