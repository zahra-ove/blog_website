<?php

namespace App\Repositories\V1\contracts;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function updateBySave(int $id, array $postData): bool;
    public function confirm(int $id): bool;
    public function reject(int $id): bool;
}
