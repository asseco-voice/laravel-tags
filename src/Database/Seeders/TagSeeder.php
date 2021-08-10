<?php

declare(strict_types=1);

namespace Asseco\Tags\Database\Seeders;

use Asseco\Tags\App\Contracts\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        /** @var Tag $tag */
        $tag = app(Tag::class);

        $tag::factory()->count(50)->create();
    }
}
