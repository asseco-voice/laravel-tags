<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Http\Controllers;

use Asseco\Tags\App\Contracts\Tag as TagContract;
use Asseco\Tags\App\Http\Requests\TagRequest;
use Asseco\Tags\App\Models\Tag;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public TagContract $tag;

    public function __construct(TagContract $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $isSystem = $request->input('is_system');
        if ($isSystem !== null) {
            return response()->json($this->tag::where('is_system', filter_var($isSystem, FILTER_VALIDATE_BOOLEAN))->get());
        }
        return response()->json($this->tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagRequest  $request
     * @return JsonResponse
     */
    public function store(TagRequest $request): JsonResponse
    {
        $tag = $this->tag::query()->create($request->validated());

        return response()->json($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  Tag  $tag
     * @return JsonResponse
     */
    public function show(Tag $tag): JsonResponse
    {
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagRequest  $request
     * @param  Tag  $tag
     * @return JsonResponse
     */
    public function update(TagRequest $request, Tag $tag): JsonResponse
    {
        $tag->update($request->validated());

        return response()->json($tag->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $isDeleted = $tag->delete();

        return response()->json($isDeleted ? 'true' : 'false');
    }
}
