<p align="center"><a href="https://see.asseco.com" target="_blank"><img src="https://github.com/asseco-voice/art/blob/main/evil_logo.png" width="500"></a></p>

# Tags

Purpose of this repository is to enable tags for any Laravel model.

## Installation

Require the package with ``composer require asseco-voice/laravel-tags``.
Service provider will be registered automatically.

## Setup

In order to use the package, migrate the tables with ``artisan migrate``
and add `Taggable` trait to model you'd like to have tag support on.

Standard CRUD endpoints are exposed for tag administration. Due to the fact that 
tags are a polymorphic relation, you have to provide your own controllers for attaching/detaching 
those tags to taggable models.

Example:

```php
// Routes
Route::post('models/{model}/tags', [ModelTagController::class, 'store']);

// Controller
public function store(Request $request, Model $model): JsonResponse
{
    $ids = Arr::get($request->validated(), 'tag_ids', []);

    $model->tags()->sync($ids);

    return response()->json('success');
}
```

# Extending the package

Publishing the configuration will enable you to change package models as
well as controlling how migrations behave. If extending the model, make sure
you're extending the original model in your implementation.
