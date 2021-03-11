<?php

use Asseco\Tags\App\Http\Controllers\TagController;
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

Route::prefix('api')->middleware('api')->group(function () {
    Route::apiResource('tags', TagController::class);

    Route::apiResource('taggables/{id}', [TaggableController::class])->only('store','destroy');
});
