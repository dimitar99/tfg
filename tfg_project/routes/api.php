<?php

use App\Http\Controllers\ApiControllers\RoutineController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function() {

    /*
    * USERS
    */
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/user', [UserController::class, 'getCurrentUser']);
    Route::post('/users/new', [UserController::class, 'store']);
    Route::put('/users/{user}/update', [UserController::class, 'update']);

    /*
    * ROUTINES
    */
    Route::get('/routines', [RoutineController::class, 'index']);
    Route::get('/routines/{type}', [RoutineController::class, 'indexByType']);

    /*
    * POSTS
    */
    Route::get('/posts', [PostController::class, 'index']);
});
