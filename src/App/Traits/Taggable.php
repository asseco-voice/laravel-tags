<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Traits;

use Asseco\Tags\App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
