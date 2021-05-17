<?php

use App\Http\Controllers\CMSApi\CategoryController;
use App\Http\Controllers\CMSApi\RoutineTypeController;
use App\Http\Controllers\CMSApi\RoutineController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'language']], function () {
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/routineTypes', RoutineTypeController::class);
    Route::apiResource('/routines', RoutineController::class);
});
