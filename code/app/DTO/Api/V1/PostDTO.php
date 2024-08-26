<?php

namespace App\DTO\Api\V1;

use DateTime;

readonly class PostDTO
{
    public function __construct(public string $title, public null|string $body,
        public null|int $category_id, public bool $publish, public null|DateTime $publish_at)
    {
    }

    public function toArray(): array
    {
        return [
            'title'       => $this->title,
            'body'        => $this->body,
            'category_id' => $this->category_id,
            'publish'     => $this->publish,
            'publish_at'  => $this->publish_at?->format('Y-m-d H:i:s'), // Format DateTime if it's not null
        ];
    }
}
