<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Models;

use Asseco\Tags\App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    /**
     * Get all attached models of the given class to the tag.
     *
     * @param string $class
     *
     * @return MorphToMany
     */
    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'taggable', 'taggables', 'tag_id', 'taggable_id', 'id', 'id');
    }

    /**
     * Get first tag(s) by name or create if not exists.
     *
     * @param mixed       $tags
     *
     * @return Collection
     */
    public static function findByNameOrCreate($tags): Collection
    {
        return collect(Taggable::parseDelimitedTags($tags))->map(function (string $tag) {
            return static::firstByName($tag) ?: static::createByName($tag);
        });
    }

    /**
     * Find tag by name.
     *
     * @param mixed       $tags
     *
     * @return Collection
     */
    public static function findByName($tags): Collection
    {
        return collect(Taggable::parseDelimitedTags($tags))->map(function (string $tag) {
            return ($exists = static::firstByName($tag)) ? $exists->getKey() : null;
        })->filter()->unique();
    }

    /**
     * Get first tag by name.
     *
     * @param string      $tag
     *
     * @return Collection
     */
    public static function firstByName(string $tag): Collection
    {
        return static::query()->where("name", $tag)->first();
    }

    /**
     * Create tag by name.
     *
     * @param string      $tag
     *
     * @return static
     */
    public static function createByName(string $tag): self
    {
        return static::create([
            'name' => $tag
        ]);
    }
}
