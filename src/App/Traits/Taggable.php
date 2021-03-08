<?php

declare(strict_types=1);

namespace Asseco\Tags\Traits;

use Asseco\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggables', 'taggable_id', 'tag_id');
    }

    public function parseDelimitedTags($tags)
    {
        return explode(',', $tags);
    }
}
