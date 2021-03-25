<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /*
    * Valida los datos, realiza registro y devuelve un access token
    */

    public function register(Request $request){

        $request->validate([
            'name' => 'required|string',
            'surnames' => 'required|string',
            'nick' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $create_token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $create_token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($create_token->token->expires_at)->toDateTimeString()
        ], 201 );

    }

    /*
    * Valida los datos de login y devuelve un access token
    */

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'string'
        ]);

        //Si el usuario no se autentifica correctamente devuelve error
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
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

    public function getCurrentUser(Request $request){

        return $request->user();

    }
}
