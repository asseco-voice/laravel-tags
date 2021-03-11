<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Traits;

use Asseco\Tags\App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use phpDocumentor\Reflection\Types\Boolean;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    /**
     * Throws exception if form exists and validate doesnt pass
     * Returns Validated data array.
     *
     * @param array $tagData
     * @return array
     * @throws Exception
     */
    public function createTagsValues(array $tagData = []): array
    {
        if (empty($tagData)) {
            return $tagData;
        }

        return $this->sync($tagData);
    }

    public function hasTags(): Boolean
    {
        return true;
    }

    /**
     * Need this hack in order to update pivot table values. Since no values
     * are actually updated when trying to create a new pivot entry, Laravel
     * will not call 'update', and trying to insert will fail because of unique
     * composite index.
     *
     * @param array $ids
     * @param string $class
     */
    public static function updateOrCreateTags(array $ids, string $class)
    {
        $tags = $class->tags()->pluck('tags.id')->toArray();

        foreach ($ids as $id) {
            if (in_array($id, $tags)) {
                $class->tags()->updateExistingPivot($id, ['updated_at' => now()]);
                continue;
            }
            $class->tags()->attach($id);
        }
    }
}
