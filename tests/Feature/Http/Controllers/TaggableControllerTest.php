<?php

//
//declare(strict_types=1);
//
//namespace Asseco\Tags\Tests\Feature\Http\Controllers;
//
//use Asseco\Tags\App\Models\Tag;
//use Asseco\Tags\Tests\TestCase;
//use Illuminate\Support\Str;
//
//class TagggableControllerTest extends TestCase
//{
//    /** @test */
//    public function can_fetch_all_tag_fields()
//    {
//        $this
//            ->getJson(route('tags.index'))
//            ->assertJsonCount(0);
//
//        Tag::factory()->count(5)->create();
//
//        $this
//            ->getJson(route('tags.index'))
//            ->assertJsonCount(5);
//
//        $this->assertCount(5, Tag::all());
//    }
//
//    /** @test */
//    public function rejects_creating_tag_with_invalid_name()
//    {
//        $request = Tag::factory()->make([
//            'name' => Str::random(101),
//        ])->toArray();
//
//        $this
//            ->postJson(route('tags.store'), $request)
//            ->assertStatus(422);
//    }
//
//    /** @test */
//    public function creates_tag()
//    {
//        $request = Tag::factory()->make()->toArray();
//
//        $this
//            ->postJson(route('tags.store'), $request)
//            ->assertJsonFragment([
//                'id'   => 1,
//                'name' => $request['name'],
//                'color' => $request['color'],
//            ]);
//
//        $this->assertCount(1, Tag::all());
//    }
//
//    /** @test */
//    public function can_return_tag_by_id()
//    {
//        Tag::factory()->count(5)->create();
//
//        $this
//            ->getJson(route('tags.show', 3))
//            ->assertJsonFragment(['id' => 3]);
//    }
//
//    /** @test */
//    public function can_update_tag()
//    {
//        $tag = Tag::factory()->create();
//
//        $request = [
//            'name' => 'updated_name',
//        ];
//
//        $this
//            ->putJson(route('tags.update', $tag->id), $request)
//            ->assertJsonFragment([
//                'name' => $request['name'],
//            ]);
//
//        $this->assertEquals($request['name'], $tag->refresh()->name);
//    }
//
//    /** @test */
//    public function can_delete_tag()
//    {
//        $tag = Tag::factory()->create();
//
//        $this->assertCount(1, Tag::all());
//
//        $this
//            ->deleteJson(route('tags.destroy', $tag->id))
//            ->assertOk();
//
//        $this->assertCount(0, Tag::all());
//    }
//}
