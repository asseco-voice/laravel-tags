<?php

namespace Asseco\Tags\App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class TaggablePivot extends MorphPivot
{
    protected $table = 'taggables';
}
