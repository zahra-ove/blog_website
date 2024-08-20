<?php

namespace App\Providers;

use App\Repositories\V1\CategoryRepository;
use App\Repositories\V1\CommentRepository;
use App\Repositories\V1\contracts\CategoryRepositoryInterface;
use App\Repositories\V1\contracts\CommentRepositoryInterface;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use App\Repositories\V1\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
