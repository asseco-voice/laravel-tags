<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Http\Controllers;

use Asseco\Tags\App\Models\Tag;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaggableController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $model = $request->get('model');
        $modelId = $request->get('id');
        $tags = $request->get('tags');

        $tag = $model::findOrFail($modelId);
        $tag->tags()->attach($tags);

        return response()->json($tag->with('tags'));
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
        $tag->tags()->detach();

        return response()->json($tag);
    }
}
