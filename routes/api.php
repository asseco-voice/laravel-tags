<?php

use Asseco\Tags\App\Http\Controllers\TagController;
use Asseco\Tags\App\Http\Controllers\TagManyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix(config('asseco-tags.routes.prefix'))
    ->middleware(config('asseco-tags.routes.middleware'))
    ->group(function () {
        Route::apiResource('tags', TagController::class);

        Route::post('tag-many', [TagManyController::class, 'store'])->name('tag-many.store');
    });
