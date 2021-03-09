<?php

declare(strict_types=1);

namespace Asseco\Tags\Database\Seeders;

use Asseco\Tags\App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::factory()->count(500)->create();
    }
}
