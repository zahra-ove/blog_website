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
}
