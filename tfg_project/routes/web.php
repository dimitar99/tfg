<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\RoutineTypesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /*
    * USER
    */
    Route::get('/users', [UserController::class, 'list'])->name('users.list');
    Route::get('/users/{id}', [UserController::class, 'show'])
        ->where('id', '[0-9]+')
        ->name('users.show');
    Route::get('/users/new', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    /*
    * POST
    */
    Route::get('/posts', [PostController::class, 'list'])->name('posts.list');
    Route::get('/posts/{id}', [PostController::class, 'show'])
        ->where('id', '[0-9]+')
        ->name('posts.show');
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');

    /*
    * COMMENT
    */
    Route::delete('/comments/{comment}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');

    /*
    * ROUTINE
    */
    Route::get('/routines', [RoutineController::class, 'list'])->name('routines.list');
    Route::get('/routines/{id}', [RoutineController::class, 'show'])
        ->where('id', '[0-9]+')
        ->name('routines.show');
    Route::get('/routines/new', [RoutineController::class, 'create'])->name('routines.create');
    Route::post('/routines/create', [RoutineController::class, 'store']);
    Route::get('/routines/{routine}/edit', [RoutineController::class, 'edit'])->name('routines.edit');
    Route::put('/routines/{routine}', [RoutineController::class, 'update']);
    Route::delete('/routines/{routine}/destroy', [RoutineController::class, 'destroy'])->name('routines.destroy');

    /*
    * ROUTINE TYPES
    */
    Route::get('/routineTypes', [RoutineTypesController::class, 'list'])->name('routineTypes.list');
    Route::get('/routineTypes/{id}', [RoutineTypesController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('routineTypes.show');
    Route::get('/routineTypes/new', [RoutineTypesController::class, 'create'])->name('routineTypes.create');
    Route::post('/routineTypes/create', [RoutineTypesController::class, 'store']);
    Route::get('/routineTypes/{routineType}/edit', [RoutineTypesController::class, 'edit'])->name('routineTypes.edit');
    Route::put('/routineTypes/{routineType}', [RoutineTypesController::class, 'update']);
    Route::delete('/routineTypes/{routineType}/destroy', [RoutineTypesController::class, 'destroy'])->name('routineTypes.destroy');
});
