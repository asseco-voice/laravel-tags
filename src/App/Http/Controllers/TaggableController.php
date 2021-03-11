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
    public function store(Request $request, $modelId): JsonResponse
    {
        $model = $request->get('model');
        $tags = $request->get('tags');

        $record = $model::where('id', $modelId)->first();
        optional($record->tags())->sync($tags);

        return response()->json($record);
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
