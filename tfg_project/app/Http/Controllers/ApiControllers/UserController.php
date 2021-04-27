<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AccountCreatedConfirmationMailable;
use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

        Mail::to($user->email)->send(new AccountCreatedConfirmationMailable());

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

        if ($user) {
            return response()->json([
                'mensaje' => 'Usuario encontrado',
                'user' => new UserResource($user)
            ], 200);
        }

        return response()->json([
            'mensaje' => 'Usuario no encontrado',
        ], 400);
    }

    /*
    * Actualiza un usuario
    */

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        if ($user){
            $user->fill([
                'name' => $request->name,
                'surnames' => $request->surnames,
                'nick' => $request->nick,
                'bio' => $request->bio,
                'email' => $request->email
            ]);

            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }

            if ($user->update()) {
                if ($request->avatar) {
                    $path = 'users/avatar_' . $user->id . '.' . $request->avatar->getClientOriginalExtension();

                    if (Storage::exists($user->avatar)) {
                        Storage::delete($user->avatar);
                    }

                    Storage::put($path, file_get_contents($request->avatar));
                    $user->update(['avatar' => $path]);
                }
                return response()->json([
                    'mensaje' => 'Usuario actualizado correctamente'
                ], 200);
            }

            return response()->json([
                'mensaje' => 'La actualizacion ha fallado'
            ], 400);
        }else{
            return response()->json([
                'mensaje' => 'Usuario no encontrado'
            ], 400);
        }
    }

    /*
    * Follow/Unfollow a un user
    */

    public function followUnfollow(Request $request, $id)
    {
        $currentUser = $request->user();
        $otherUser = User::where('id', $id)->first();

        if ($otherUser) {
            // Es el id de la tabla users porque followers() y followed()
            // pertenecen a dicha tabla
            if ($currentUser->followers()->where('id', $id)->first() != null) {
                $currentUser->followers()->detach($id);
                return response()->json([
                    'mensaje' => 'Unfollow'
                ], 200);
            } else {
                $currentUser->followers()->attach($id);
                return response()->json([
                    'mensaje' => 'Follow'
                ], 200);
            }
        } else {
            return response()->json([
                'mensaje' => 'Usuario no encontrado'
            ], 400);
        }
    }

    /*
    * Formulario de Contacto
    */

    public function contact(Request $request)
    {
        $body = $request->body;

        Mail::to("dimitar2015@gmail.com")->send(new ContactMailable($request, $body));
    }
}
