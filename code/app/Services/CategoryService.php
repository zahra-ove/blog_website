<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function store($data): Model
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        return $this->categoryRepository->store($data);
    }


}
