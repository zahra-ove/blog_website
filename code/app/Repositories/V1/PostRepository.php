<?php

namespace App\Repositories\V1;

use App\Models\Post;
use App\Repositories\V1\contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }
}
