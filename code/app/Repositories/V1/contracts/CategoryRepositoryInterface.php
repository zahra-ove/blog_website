<?php

namespace App\Repositories\V1\contracts;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function findBySlug(string $slug);
}
