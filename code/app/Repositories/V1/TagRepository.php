<?php

namespace App\Repositories\V1;


use App\Models\Tag;
use App\Repositories\V1\contracts\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function __construct(Tag $tag)
    {
        parent::__construct($tag);
    }

    public function insertMany(array $tags): array
    {
        $tag_ids = [];
        foreach($tags as $tag) {
            $tag = Tag::query()->create(['name' => $tag]);
            $tag_ids[] = $tag['id'];
        }

        return $tag_ids;
    }
}
