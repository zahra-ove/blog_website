<?php

namespace App\Repositories\V1\contracts;

interface CommentRepositoryInterface extends RepositoryInterface
{
    public function confirm(int $id): bool;
}
