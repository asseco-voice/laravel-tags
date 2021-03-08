<?php

namespace Asseco\Tags\App\Http\Controllers;

use Asseco\Tags\App\Http\Requests\TagRequest;
use Asseco\Tags\App\Models\Tag;
use Exception;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return JsonResponse
     */
    public function store(TagRequest $request): JsonResponse
    {
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function show(Tag $tag): JsonResponse
    {
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $isDeleted = $tag->delete();

        return response()->json($isDeleted ? 'true' : 'false');
    }
}
