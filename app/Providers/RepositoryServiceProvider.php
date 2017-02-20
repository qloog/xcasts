<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Repositories\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\RoleRepository::class, \App\Repositories\Eloquent\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\PermissionRepository::class, \App\Repositories\Eloquent\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\NewsRepository::class, \App\Repositories\Eloquent\NewsRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\NewsCategoryRepository::class, \App\Repositories\Eloquent\NewsCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\AlbumRepository::class, \App\Repositories\Eloquent\AlbumRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\EventRepository::class, \App\Repositories\Eloquent\EventRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\TopicRepository::class, \App\Repositories\Eloquent\TopicRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\SeriesRepository::class, \App\Repositories\Eloquent\SeriesRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\LessonRepository::class, \App\Repositories\Eloquent\LessonRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\CommentRepository::class, \App\Repositories\Eloquent\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ReplyRepository::class, \App\Repositories\Eloquent\ReplyRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\VoteRepository::class, \App\Repositories\Eloquent\VoteRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\GoodsRepository::class, \App\Repositories\Eloquent\GoodsRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\OrdersRepository::class, \App\Repositories\Eloquent\OrdersRepositoryEloquent::class);
        //:end-bindings:
    }
}
