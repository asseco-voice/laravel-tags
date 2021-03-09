<?php

declare(strict_types=1);

use Asseco\Tags\App\Models\Tag;
use Asseco\Tags\App\Traits\Taggable;

return [
    /**
     * Path to Laravel models in 'path => namespace' format.
     *
     * This does not recurse in folders, so you need to specify
     * an array of paths if non-standard models are to be used
     */
    'models_path' => [
        app_path('Models') => 'App\\Models\\',
    ],

    /**
     * Namespace to Taggables trait.
     */
    'trait_path'  => Taggables::class,
];
