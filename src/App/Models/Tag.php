<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'taggable');
    }
}
