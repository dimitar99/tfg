<?php

use App\Http\Controllers\ApiControllers\RoutineController;
use App\Http\Controllers\ApiControllers\PostsController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\RoutineTypesController;
use App\Http\Controllers\ApiControllers\PostController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'] );

Route::group(['middleware' => ['auth:api']], function() {

    /*
    * USERS
    */
    Route::get('/user', [UserController::class, 'getCurrentUser']);
    Route::get('/users/{user}', [UserController::class, 'getUser']);
    //Route::post('/users/new', [UserController::class, 'store']);
    //Route::put('/users/{user}/update', [UserController::class, 'update']);

    /*
    * ROUTINES
    */
    Route::get('/routines', [RoutineController::class, 'getRoutines']);

    /*
    * POSTS
    */
    Route::get('/posts', [PostsController::class, 'getPosts']);
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy']);

    /*
    * ROUTINES TYPE
    */
    Route::get('/routinesTypes', [RoutineTypesController::class, 'getTypes']);
});
