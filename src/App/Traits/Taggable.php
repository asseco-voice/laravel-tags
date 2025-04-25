<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Traits;

use Asseco\Tags\App\Contracts\Tag;
use Asseco\Tags\App\Models\TaggablePivot;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(get_class(app(Tag::class)), 'taggable')->using(TaggablePivot::class)->withTimestamps();
    }
}
