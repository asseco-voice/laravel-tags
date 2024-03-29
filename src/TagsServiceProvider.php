<?php

declare(strict_types=1);

namespace Asseco\Tags;

use Asseco\Tags\App\Contracts\Tag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TagsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/asseco-tags.php', 'asseco-tags');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        if (config('asseco-tags.migrations.run')) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        }
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../migrations' => database_path('migrations'),
        ], 'asseco-tags');

        $this->publishes([
            __DIR__ . '/../config/asseco-tags.php' => config_path('asseco-tags.php'),
        ], 'asseco-tags');

        $this->app->bind(Tag::class, config('asseco-tags.models.tag'));

        Route::model('tag', get_class(app(Tag::class)));
    }
}
