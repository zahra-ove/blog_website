<?php

namespace App\Repositories\V1;

use App\Models\Category;
use App\Repositories\V1\contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(public Category $category)
    {
        parent::__construct($category);
    }

    public function findBySlug(string $slug)
    {
        return $this->category->where('slug', 'like', $slug . '%')->get();
    }
}
