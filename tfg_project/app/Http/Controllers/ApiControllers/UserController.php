<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
    * Valida los datos, realiza registro y devuelve un access token
    */

    public function register(CreateUserRequest $request)
    {
        $data = ([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user = User::create($data);

        $create_token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $create_token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($create_token->token->expires_at)->toDateTimeString()
        ], 201);
    }

    /*
    * Valida los datos de login y devuelve un access token
    */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        //Si el usuario no se autentifica correctamente devuelve error
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 400);
        }

        //Usuario autenticado
        $user = Auth::user();

        //Se crea un access token para el usuario
        $create_token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $create_token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($create_token->token->expires_at)->toDateTimeString()
        ]);
    }

    /*
    * Devuelve el usuario que hay logeado actualmente
    */

    public function getCurrentUser(Request $request)
    {
        return new UserResource($request->user());
    }

    /*
    * Muestra el detalle de un usuario
    */

    public function getUser($id)
    {
        $user = User::findOrFail($id);

        if ($user){
            return response()->json([
                'mensaje' => 'Usuario encontrado ',
                'user' => new UserResource($user)
            ], 200);
        }

        return response()->json([
            'mensaje' => 'Usuario no encontrado',
        ], 400);
    }

    /*
    * Editar un usuario
    */

    public function edit(Request $request)
    {

    }

    /*
    * Actualiza un usuario
    */

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->updateUser($user)) {
            return response()->json([
                'mensaje' => 'Usuario actualizado correctamente'
            ], 200);
        }

        return response()->json([
            'mensaje' => 'La actualizacion ha fallado'
        ], 400);
    }

}
