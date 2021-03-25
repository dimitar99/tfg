<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//REGISTRO
Route::post('/register', [UserController::class, 'register']);

//LOGIN
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function() {

    //USUARIO ACTUAL
    Route::get('/user', [UserController::class, 'getCurrentUser']);

    //LISTADO USUARIOS
    Route::get('/users', [UserController::class, 'index']);

    //CREAR USUARIO
    Route::post('/users/new', [UserController::class, 'store']);

    //ELIMINAR USUARIO
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy']);

    //ACTUALIZAR USUARIO
    Route::put('/users/{user}/update', [UserController::class, 'update']);

});