<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Http\Controllers;

use Asseco\Tags\App\Http\Requests\ModelTagRequest;
use Asseco\Tags\App\Traits\Taggable;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class ModelTagController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ModelTagRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(ModelTagRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $model = $this->getModel($validated);

        $model->tags()->sync(Arr::get($validated, 'tag_ids'));

        return response()->json($model);
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     */
    protected function getModel(array $data): Model
    {
        $modelNamespace = Arr::get($data, 'model');
        $modelId = Arr::get($data, 'model_id');

        if (!$modelNamespace instanceof Model) {
            throw new Exception("$modelNamespace is not a valid model namespace");
        }

        $model = $modelNamespace::query()->where('id', $modelId)->firstOrFail();

        if (!method_exists($model, 'tags')) {
            throw new Exception("$modelNamespace doesn't have a tags() method. Did you forget to use a " . Taggable::class . ' trait?');
        }

        return $model;
    }
}
