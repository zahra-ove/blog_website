<?php

namespace App\Providers;

use App\Repositories\V1\CategoryRepository;
use App\Repositories\V1\CommentRepository;
use App\Repositories\V1\contracts\CategoryRepositoryInterface;
use App\Repositories\V1\contracts\CommentRepositoryInterface;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use App\Repositories\V1\contracts\SavedRepositoryInterface;
use App\Repositories\V1\contracts\TagRepositoryInterface;
use App\Repositories\V1\PostRepository;
use App\Repositories\V1\SavedRepository;
use App\Repositories\V1\TagRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(SavedRepositoryInterface::class, SavedRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
