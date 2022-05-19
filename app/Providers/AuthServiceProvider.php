<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Share;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\SharePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Post' => 'App\Policies\PostPolicy',
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        User::class => UserPolicy::class,
        Share::class => SharePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
