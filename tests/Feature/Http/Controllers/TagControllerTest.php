<?php

declare(strict_types=1);

namespace Asseco\Tags\Tests\Feature\Http\Controllers;

use Asseco\Tags\App\Contracts\Tag;
use Asseco\Tags\Tests\TestCase;
use Illuminate\Support\Str;

class TagControllerTest extends TestCase
{
    protected Tag $tag;

    public function setUp(): void
    {
        parent::setUp();

        $this->tag = app(Tag::class);
    }

    /** @test */
    public function can_fetch_all_tag_fields()
    {
        $this
            ->getJson(route('tags.index'))
            ->assertJsonCount(0);

        $this->tag::factory()->count(5)->create();

        $this
            ->getJson(route('tags.index'))
            ->assertJsonCount(5);

        $this->assertCount(5, $this->tag::all());
    }

    /** @test */
    public function rejects_creating_tag_with_invalid_name()
    {
        $request = $this->tag::factory()->make([
            'name' => Str::random(101),
        ])->toArray();

        $this
            ->postJson(route('tags.store'), $request)
            ->assertStatus(422);
    }

    /** @test */
    public function creates_tag()
    {
        $request = $this->tag::factory()->make()->toArray();

        $this
            ->postJson(route('tags.store'), $request)
            ->assertJsonFragment([
                'id'   => 1,
                'name' => $request['name'],
                'color' => $request['color'],
            ]);

        $this->assertCount(1, $this->tag::all());
    }

    /** @test */
    public function can_return_tag_by_id()
    {
        $this->tag::factory()->count(5)->create();

        $this
            ->getJson(route('tags.show', 3))
            ->assertJsonFragment(['id' => 3]);
    }

    /** @test */
    public function can_update_tag()
    {
        $tag = $this->tag::factory()->create();

        $request = [
            'name' => 'updated_name',
        ];

        $this
            ->putJson(route('tags.update', $tag->id), $request)
            ->assertJsonFragment([
                'name' => $request['name'],
            ]);

        $this->assertEquals($request['name'], $tag->refresh()->name);
    }

    /** @test */
    public function can_delete_tag()
    {
        $tag = $this->tag::factory()->create();

        $this->assertCount(1, $this->tag::all());

        $this
            ->deleteJson(route('tags.destroy', $tag->id))
            ->assertOk();

        $this->assertCount(0, $this->tag::all());
    }
}
