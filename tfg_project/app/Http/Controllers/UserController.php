<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /*
    * Valida los datos, realiza registro y devuelve un access token
    */

    public function register(UserCreateRequest $request){

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
        ], 201 );

    }

    /*
    * Valida los datos de login y devuelve un access token
    */

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
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

        return new UserResource($request->user());

    }

    /*
    * Devuelve el listado de usuarios paginado
    */

    public function index(){

        $users = User::paginate(10);
        return UserResource::collection($users);

    }

    /*
    * Crea un usuario
    */

    public function store(UserCreateRequest $request){

        $user = User::create([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'mensaje' => 'Usuario creado correctamente'
        ]);

    }
    
    /*
    * Actualiza un usuario
    */

    public function update(UserUpdateRequest $request, User $user){
        
        $user = User::find($user->id);
        
        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->nick = $request->nick;
        $user->email = $request->email;

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        if($user->save()){
            return response()->json([
                'Usuario actualizado correctamente'
            ], 200);
        }

        return response()->json([
            'La actualizacion ha fallado'
        ], 400);

    }

    /*
    * Elimina un usuario
    */

    public function destroy(User $user){

        $user = User::find($user->id);
        
        if($user->delete()){
            return response()->json([
                'mensaje' => 'Usuario eliminado correctamente'
            ], 200);
        }

        return response()->json([
            'mensaje' => 'La eliminacion ha fallado'
        ], 400);

    }

}
