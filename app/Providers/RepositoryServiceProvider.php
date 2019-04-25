<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\BlogPostRepository;
use App\Repositories\Contracts\BlogCategoryRepository;

use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Eloquent\EloquentBlogPostRepository;
use App\Repositories\Eloquent\EloquentBlogCategoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(BlogPostRepository::class, EloquentBlogPostRepository::class);
        $this->app->bind(BlogCategoryRepository::class, EloquentBlogCategoryRepository::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
