<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public function tags(): MorphToMany
    {
        $model = config('asseco-tags.tag_model');

        return $this->morphToMany($model, 'taggable')->withTimestamps();
    }
}
