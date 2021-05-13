<?php

use App\Http\Controllers\CMSApi\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::apiResource('/categories', CategoryController::class);
});
