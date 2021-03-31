<?php

declare(strict_types=1);

namespace Asseco\Tags;

use Illuminate\Support\ServiceProvider;

class TagsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        //
    }
}
