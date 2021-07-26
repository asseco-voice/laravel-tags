<?php

use Asseco\Tags\App\Models\Tag;

return [
    /**
     * Model which will be bound to the app.
     */
    'tag_model'       => Tag::class,

    /**
     * Should the package run the migrations. Set to false if you're publishing
     * and changing default migrations.
     */
    'runs_migrations' => true,
];
