<?php

use App\Http\Controllers\ApiControllers\CommentController;
use App\Http\Controllers\ApiControllers\RoutineController;
use App\Http\Controllers\ApiControllers\PostController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\RoutineTypesController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'] );

Route::group(['middleware' => ['auth:api']], function() {

    /*
    * USERS
    */
    Route::get('/user', [UserController::class, 'getCurrentUser']);
    Route::get('/users/{user}', [UserController::class, 'getUser']);
    Route::post('/users/{user}/update', [UserController::class, 'update']);
    Route::post('/users/{user}/followUnfollow', [UserController::class, 'followUnfollow']);

    /*
    * POSTS
    */
    Route::get('/posts', [PostController::class, 'getPosts']);
    //Route::get('/posts/followed', [PostController::class, 'getPostsFromFollowed']);
    Route::post('/posts/new', [PostController::class, 'create']);
    Route::post('/posts/{post}/update', [PostController::class, 'update']);
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy']);
    Route::post('/posts/{posts}/likeDislike', [PostController::class, 'likeDislike']);

    /*
    * COMENTARIOS
    */
    Route::post('/comments/new', [CommentController::class, 'create']);
    Route::post('/comments/{comment}/update', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}/destroy  ', [CommentController::class, 'destroy']);

    /*
    * ROUTINES
    */
    Route::get('/routines', [RoutineController::class, 'getRoutines']);

    /*
    * ROUTINES TYPE
    */
    Route::get('/routinesTypes', [RoutineTypesController::class, 'getTypes']);

});
