<?php

namespace App\Repositories\V1\contracts;

interface TagRepositoryInterface extends RepositoryInterface
{
    public function insertMany(array $tags): array;
}
