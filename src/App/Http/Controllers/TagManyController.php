<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Http\Controllers;

use Asseco\Tags\App\Http\Requests\TagManyRequest;
use Asseco\Tags\App\Traits\Taggable;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TagManyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param TagManyRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(TagManyRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $modelString = $validated['model'];

        // Assume the namespace was forwarded if no morph map was found
        /** @var Model $modelClass */
        $modelClass = Relation::getMorphedModel($modelString) ?: $modelString;

        if (!class_exists($modelClass)) {
            throw new Exception("'$modelString' is not recognized as an existing model in this app.");
        }

        if (!method_exists($modelClass, 'tags')) {
            throw new Exception("'$modelClass' model must implement Taggable trait.");
        }

        foreach ($validated['ids'] as $modelId) {

            /** @var Taggable $model */
            $model = $modelClass::query()->find($modelId);

            if (!$model) {
                Log::info("Couldn't find model '$modelClass' with ID: $modelId. Skipping adding tags...");
            }

            $model->tags()->syncWithoutDetaching($validated['tag_ids']);
        }

        return response()->json('success');
    }
}
