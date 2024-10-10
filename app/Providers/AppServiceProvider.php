<?php

namespace App\Providers;

use App\Models\Bleu\Article;
use App\Models\Bleu\Comment;
use App\Models\Bleu\Tag;
use App\Policies\Bleu\ArticlePolicy;
use App\Policies\Bleu\CommentPolicy;
use App\Policies\Bleu\TagPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(Tag::class, TagPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}
