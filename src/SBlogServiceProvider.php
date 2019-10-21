<?php

namespace Pdusan\SimpleBlog;

use Gate;
use Illuminate\Support\ServiceProvider;
use Pdusan\SimpleBlog\Models\SBlogComment;
use Pdusan\SimpleBlog\Models\SBlogPost;
use Pdusan\SimpleBlog\Policies\SBlogPostPolicy;
use Pdusan\SimpleBlog\Policies\SBlogCommentPolicy;

class SBlogServiceProvider extends ServiceProvider
{

    protected $policies = [
        SBlogPost::class => SBlogPostPolicy::class,
        SBlogComment::class => SBlogCommentPolicy::class,
    ];

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        // Ensure default config values are set for those that are used in two or more places
        if (empty(config('sblog.config_namespace'))) {
            config(['sblog.config_namespace' => 'sblog']);
        }
        if (empty(config('sblog.asstes_namespace'))) {
            config(['sblog.asstes_namespace' => 'sblog']);
        }
        if (empty(config('sblog.view_namespace'))) {
            config(['sblog.view_namespace' => 'sblog']);
        }
        if (empty(config('blog.trans_namespace'))) {
            config(['sblog.trans_namespace' => 'sblog']);
        }
        $this->mergeConfigFrom(__DIR__ . '/../config/sblog.php', config('sblog.config_namespace'));
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', config('sblog.view_namespace'));
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', config('sblog.trans_namespace'));
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->offerPublishing();

        $this->registerPolicies();
    }

    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * Setup the resource publishing groups.
     */
    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/sblog.php' => config_path('sblog.php'),
        ], 'sblog-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/' . config('sblog.view_namespace')),
        ], 'sblog-views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/' . config('sblog.trans_namespace')),
        ], 'sblog-translations');

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/' . config('sblog.asstes_namespace')),
        ], 'sblog-assets');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'sblog-migrations');
    }

}
